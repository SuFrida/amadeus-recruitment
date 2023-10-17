<!-- 
// PRUEBA - DASHBOARD 1 -- Frida Bonilla Vizcarra

// En esta prueba se me pidió desarrollar un dashboard para un sistema de gestión de alumnos y profesores para la plataforma Amadeus.
// Durante la prueba he sentido que la instalación y configuración del proyecto ha sido muy sencilla y rápida de comprender.
// En cuanto a la estructura de carpetas, componentes y nomeclaturas, me han parecido muy intuitivas y aportan una excelente estructura y organización al proyecto.
// Debido a que ya he trabajado anteriormente con Vue, tanto en proyectos freelance basados en Nuxt como en proyectos grandes con empresas internacionales.
// Como HMD Trucking, donde contribuí a diseñar y desarrollar un Transport Management System basado en Laravel + Vue.
// En cuanto a los inconvenientes que se me presentaron durante la prueba, puedo destacar el inconveniente con el email y contraseña de acceso, el cual se solucionó gracias al apoyo de José y el equipo de Mowatave.
// También puedo destacar el debugging de algunos errores de consola que se llegaron a presentar al momento de buscar los props de los componentes y la información de alumnos y profesores. Lo cual se solucionó muy fácil gracias a las instrucciones claras de la prueba en cuanto al manejo de Props.
// Genuinamente esta prueba me pareció muy interesante, divertida y sencilla de realizar. Pocas veces me he encontrado con pruebas tan bien estructuradas y organizadas como esta. Ha sido un placer realizarla y espero poder seguir avanzando en el proceso de selección para aportar mis conocimientos de diseño y desarrollo al equipo de Mowatave y todos los proyectos de innovación que se desarrollan en la empresa. 
-->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps ({
    customroute: {
        type: String,
        default: () => "dashboard",
    },
    data: {
        type: Array,
        default: () => [],
    },
    events: {
        type: Array,
        default: () => [],
    },
});

// Define a function to format the date
const formatDate = (dateString) => {
  const [year, month, day] = dateString.split('-');
  return `${day}/${month}`;
};

const formatMonth = (dateString) => {
    const months = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
  ];

  if (dateString >= 1 && dateString <= 12) {
    return months[dateString - 1];
  } else {
    return 'Invalid Month';
  }
};

const hours = computed(() => props.data.accumulative_hours.hours);
const minutes = computed(() => props.data.accumulative_hours.minutes);
const month = computed(() => props.data.accumulative_hours.month);
const completitionPercentage = computed(() => props.data.completition_percentage);
const assistence = computed(() => props.data.assistence);
const averageMark = computed(() => props.data.average_mark);
const messagesUnread = computed(() => props.data.messages_unread);
const studentCourses = computed(() => props.events.timetable);
const studentEvents = computed(() => props.events.events);
const studentProfExams = computed(() => props.events.tests);
const profCourses = computed(() => props.events.signature);
const subjectsCharge = computed(() => props.data.subjects_in_charge);
const marks = computed(() => props.events.marks);


const isBlue = computed(() => {
    let isBlue = false;
    if (profCourses) {
        isBlue = true;
    } else {
        isBlue = false;
    }
    return isBlue;
});

const isRed = computed(() => {
    let isRed = false;
    if (marks) {
        isRed = true;
    } else {
        isRed = false;
    }
    return isRed;
});

const isTeal = computed(() => {
    let isTeal = false;
    if (studentProfExams) {
        isTeal = true;
    } else {
        isTeal = false;
    }
    return isTeal;
});
</script>



<template>
    <Head title="Inicio" />

    <AuthenticatedLayout :croute="customroute">
        <!-- ADMIN DESIGN PROF + STUDENT -->
        <div class="mx-auto">
            <h1 class="welcome">Hola, {{ $page.props.auth.user.name }}</h1>
            <!-- Summary -->
            <div class="container">
                <div class="row">
                    <div class="card-col col-sm-12 col-lg-4">
                        <div class="card">
                            <div class="card-container">
                                <div class="card-icon">
                                    <i class="fa-regular fa-clock-nine"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">
                                        <p>Horas Acumuladas</p>
                                    </div>
                                    <div class="card-text">
                                        <p>{{ hours }}h {{ minutes }}´ {{ formatMonth(month) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-col col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-container">
                                <div class="card-icon">
                                    <i class="fa-regular fa-user-check"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">
                                        <p>Asistencia</p>
                                    </div>
                                    <div class="card-text">
                                        {{ assistence }}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card-col col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-container">
                                <div class="card-icon">
                                    <i class="fa-solid fa-chart-simple"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">
                                        <p>Materias</p>
                                    </div>
                                    <div class="card-text">
                                        <p>{{subjectsCharge }} a cargo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-col col-sm-12 col-lg-2">
                        <div class="card">
                            <div class="card-container">
                                <div class="card-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-text">
                                        {{ messagesUnread }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-col col-sm-12 col-lg-4">
                        <div class="card">
                            <div class="card-container">
                                <div class="card-icon">
                                    <i class="fa-regular fa-graduation-cap"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">
                                        <p>Porcentaje de Cursada</p>
                                    </div>
                                    <div class="card-text">
                                        {{ completitionPercentage   }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-col col-sm-12 col-lg-3">
                        <div class="card">
                            <div class="card-container">
                                <div class="card-icon">
                                    <i class="fa-solid fa-chart-simple"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-title">
                                        <p>Promedio</p>
                                    </div>
                                    <div class="card-text">
                                        {{ averageMark  }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Next Tasks -->
            <h3 class="tasks">Tus Próximas Tareas</h3>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-task">
                            <div class="card-task-container">
                                <div class="card-tag" :class="{'blue-bg' : isBlue}">
                                    <p>Firma Jornada</p>
                                </div>
                                <div class="card-list">
                                    <ul v-for="(course, index) in profCourses" :key="index">
                                        <li :class="{'pending' : course.status === 'pending'}">
                                            <p class="title" :class="{'circle-blue' : isBlue}">{{ formatDate(course.date) }} {{ course.title }}</p>
                                            <p v-if="course.status === 'scheduled'" class="subtitle">Registro: {{ course.hour }}pm</p>
                                            <p class="subtitle" v-else><u>Registro pendiente</u></p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-anchor">
                                    <a class="anchor" href="#">+ Ver Más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-task">
                            <div class="card-task-container">
                                <div class="card-tag" :class="{'red-bg' : isRed}">
                                    <p>Calificaciones</p>
                                </div>
                                <div class="card-list">
                                    <ul v-for="(course, index) in marks" :key="index">
                                        <li >
                                            <p class="title" :class="{'circle-red' : isRed}">{{ formatDate(course.date) }} {{ course.title }}</p>
                                            <p class="subtitle">{{ course.desc }}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-anchor" style="margin-top: 20%;">
                                    <a class="anchor" href="#">+ Ver Más Calificaciones</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-task">
                            <div class="card-task-container">
                                <div class="card-tag" :class="{'teal-bg' : isTeal}">
                                    <p>Exámenes</p>
                                </div>
                                <div class="card-list">
                                    <ul v-for="(course, index) in studentProfExams" :key="index">
                                            <li>
                                                <p class="title" :class="{'circle-teal' : isTeal}">{{ formatDate(course.date) }} {{ course.title }}</p>
                                                <p class="subtitle">{{ course.start_hour }} - {{ course.end_hour }} pm</p>
                                            </li>
                                        </ul>
                                </div>
                                <div class="card-anchor" style="margin-top: 20%;">
                                    <a class="anchor" href="#">+ Ver Más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-task">
                            <div class="card-task-container">
                                <div class="card-tag" :class="{'blue-bg' : isBlue}">
                                    <p>Cursada</p>
                                </div>
                                <div class="card-list">
                                    <ul v-for="(course, index) in studentCourses" :key="index">
                                        <li>
                                            <p class="title" :class="{'circle-blue' : isBlue}">{{ formatDate(course.date) }} {{ course.title }}</p>
                                            <p class="subtitle">{{ course.start_hour }} - {{ course.end_hour }} pm</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-anchor">
                                    <a class="anchor" href="#">+ Ver Más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-lg-4">
                        <div class="card-task">
                            <div class="card-task-container">
                                <div class="card-tag" :class="{'red-bg' : isRed}">
                                    <p>Eventos</p>
                                </div>
                                <div class="card-list">
                                    <ul v-for="(course, index) in studentEvents" :key="index">
                                        <li>
                                            <p class="title" :class="{'circle-red' : isRed}">{{ formatDate(course.date) }} {{ course.title }}</p>
                                            <p class="subtitle">{{ course.start_hour }} - {{ course.end_hour }} pm</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-anchor">
                                    <a class="anchor" href="#">+ Ver Más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bottom Buttons -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card-bottom">
                            <div class="card-container">
                                <div class="card-icon">
                                    <i class="fa-light fa-user-graduate"></i>
                                </div>
                                <div class="card-content">
                                    <p>ALUMNADO</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card-bottom">
                            <div class="card-container">
                                <div class="card-icon">
                                    <i class="fa-light fa-user"></i>
                                </div>
                                <div class="card-content">
                                    <p>MI ASISTENCIA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style lang="scss" scoped>

.amadeus-box {
    background: #3C7FF8;
    border-radius: 2rem;
    font-size: 1.5rem;
	color: #fff;
    font-weight: 800;
    font-size: 2.5rem;
    text-align: center;
}

.welcome {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--color-title);
    line-height: 41.51px;
    padding-left: 1.5%;
}

.card-col {
    margin-bottom: 2%;
    > .card {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
        height: 101px;
        padding: 10px 25px;
        box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.20);
        border-radius: 1rem;
        margin: 0;
        > .card-container {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            width: 100%;
            > .card-icon {
                border-radius: 100%;
                width: 50px;
                height: 50px;
                box-shadow: 0 0 10px rgba(50, 50, 50, 0.2);
                display: flex;
                justify-content: center;
                align-items: center;
                margin-right: 8%;
                > i {
                    font-size: 24px;
                    color: var(--color-primary);
                }
            }
            > .card-content {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: flex-start;
                gap: 0.5rem;
                > .card-title {
                    font-size: 16px;
                    font-weight: 400;
                    color: var(--color-dark);
                    line-height: 24px;
                    margin-bottom: 0;
                    > p {
                        margin-bottom: 0;
                    }
                }
                > .card-text {
                    font-size: 18px;
                    font-weight: 600;
                    color: var(--color-title);
                    line-height: 27px;
                    margin-bottom: 0;
                    > p {
                        margin-bottom: 0;
                    }
                }
            }
        }
    }
}
.tasks {
    font-size: 14px;
    font-weight: 600;
    color: var(--color-title);
    line-height: 28.01px;
    margin-top: 1%;
    padding-left: 1.5%;
}
.card-task {
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    background-color: transparent;
    min-height: 6.5rem;
    height: 246px;
    padding: 20px;
    box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.20);
    border-radius: 2rem;
    margin: 6% 1%;
    > .card-task-container {
        width: 100%;
        > .card-tag {
            color: var(--white);
            font-weight: 600;
            font-size: 10px;
            line-height: 15.51px;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3px 5px;
            width: fit-content;
            width: 50%;
            margin-left: 6%;
            > p {
                margin-bottom: 0;
            }
            &.blue-bg {
            background-color: var(--color-title) !important;
            }

            &.red-bg {
            background-color: var(--color-red-light) !important;
            }

            &.teal-bg {
            background-color: var(--color-aqua) !important;
            }
        }
        > .card-list {
            margin-top: 2%;
            > ul {
                list-style: none;
                padding-left: 6%;
                margin-bottom: 3%;
                &::marker {
                    color: var(--color-primary);
                }
                > li {
                    font-size: 12px;
                    font-weight: 400;
                    color: var(--color-dark);
                    line-height: 21px;
                    padding: 5px;
                    border-radius: 10px;
                    &.pending {
                        > .title::before {
                            color: var(--color-red) !important;
                        }
                        > .subtitle {
                            color: var(--color-red) !important;
                            font-weight: 600 !important;
                            cursor: pointer;
                        }
                    }
                    > .title {
                        font-weight: 700;
                        color: var(--color-dark);
                        line-height: 18px;
                        margin-bottom: 0;
                        &::before {
                            content: "●";
                            margin-right: 8px; 
                            display: inline;
                        }
                        &.circle-blue::before {
                            color: var(--color-title);
                        }
                        &.circle-red::before {
                            color: var(--color-red-light);
                        }
                        &.circle-teal::before {
                            color: var(--color-aqua);
                        }
                    }
                    > .subtitle {
                        font-weight: 400;
                        color: var(--color-dark);
                        line-height: 15.51px;
                        margin-bottom: 0;
                    }
                }
            }
        }
        > .card-anchor {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            
            > .anchor {
                font-size: 11px;
                font-weight: 600;
                color: var(--color-primary);
                line-height: 25px;
                margin-bottom: 0;
                text-decoration: none;
                border-bottom: 2px solid var(--color-primary);
                &:hover {
                    color: var(--color-title);
                    border-bottom: 2px solid var(--color-title);
                }
            }
        }
    }
}

.card-bottom {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: transparent;
    height: 101px;
    padding: 10px 15px;
    box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.20);
    border-radius: 1rem;
    cursor: pointer;
    margin-top: 6%;
    &:hover {
        background-color: var(--color-primary);
        > .card-container {
            > .card-content {
                > p {
                    color: var(--white);
                }
            }
            > .card-icon {
                > i {
                    color: var(--white);
                }
            }
        }
    }
    > .card-container {
        display: flex;
        flex-direction: row;
        justify-content: space-evenly;
        align-items: center;
        width: 100%;
        > .card-icon {
            border-radius: 100%;
            width: 50px;
            height: 50px;
            box-shadow: 0 0 10px rgba(50, 50, 50, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            > i {
                font-size: 24px;
                color: var(--color-primary);
            }
        }
        > .card-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            > p {
                font-size: 18px;
                font-weight: 600;
                color: var(--color-primary);
                line-height: 27px;
                margin-bottom: 0;
                letter-spacing: 3%;
            }
        }
    }
}

/* Estilos para móviles */
@media only screen and (max-width: 599px) {
    /* Estilos específicos para móviles aquí */
}

/* Estilos para tablets y escritorios */
@media only screen and (min-width: 600px) {
    /* Estilos específicos para tablets y escritorios aquí */
		/* Esto puedes dejarlo vacio */
}

/* Large devices (laptops/desktops, 990px and up) */

</style>