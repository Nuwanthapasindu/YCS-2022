<template>
    <nav class="row nav">
        <div class="container py-2  sm-px-0 lg-px-4">
            <small>
                <span>{{ hours }} : </span>
                <span>{{ minutes }} : </span>
                <span>{{ seconds }}</span>
                <span>{{ type }}</span>
            </small>
            <span class="WelcomeText">
                {{ WelcomeText }}
            </span>
            <div class="info">
                <span> Nuwantha Pasindu</span>
                <div class="user">
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
                        alt="" srcset="">
                </div>
                <div class="hamburger" @click="toggleNav()" :class="nav_active ? 'active' : ''">
                    <div class="bar"></div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {

    data() {
        return {
            nav_active: false,
            hours: 0,
            minutes: 0,
            seconds: 0,
            type: 'AM',
            WelcomeText: ''
        }
    },
    mounted() {
        setInterval(() => this.setTime(), 1000)
    },

    methods: {
        setTime() {
            const date = new Date();
            let hours = date.getHours();
            let minutes = date.getMinutes();
            let seconds = date.getSeconds();
            hours = hours <= 9 ? `${hours}`.padStart(2, 0) : hours;
            minutes = minutes <= 9 ? `${minutes}`.padStart(2, 0) : minutes;
            seconds = seconds <= 9 ? `${seconds}`.padStart(2, 0) : seconds;

            this.type = hours < 12 ? 'AM' : 'PM';
            this.WelcomeText = hours < 12 ? `Good Morning !!!` : `Good Evening !!!`;
            this.hours = hours;
            this.minutes = minutes;
            this.seconds = seconds;
        },


        toggleNav() {
            this.nav_active = !this.nav_active
            this.$emit('toggleNav', this.nav_active)
        },

    },
}
</script>

<style lang="scss" scoped>
.nav {
    background: var(--dashboard-main);

    .container {
        display: flex;
        align-items: center;
        justify-content: space-between;

        .info {
            border-left: 1px solid var(--dashboard-color);
            width: auto;
            display: flex;
            align-items: center;
            flex-direction: row;
            justify-content: space-between;

            span {
                font-size: 12px;
                margin: 0 1rem;
                color: var(--dashboard-color);
                font-weight: 900;
            }

            .user {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                border: 2px solid var(--dashboard-color);
                padding: 2px;
                overflow: hidden;
                cursor: pointer;
                margin: 0 1rem;

                img {
                    border-radius: 50%;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    object-position: center;
                }
            }

            .hamburger {
                transition: all .5s ease-in-out;
                width: 30px;
                height: 25px;
                position: relative;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                display: none;

                &::after {
                    transition: all .5s ease-in-out;
                    content: '';
                    border-radius: 10px;
                    width: 100%;
                    height: 3px;
                    position: absolute;
                    top: 5%;
                    left: 0;
                    background: var(--dashboard-color);
                }

                &::before {
                    transition: all .5s ease-in-out;
                    content: '';
                    border-radius: 10px;
                    width: 100%;
                    height: 3px;
                    position: absolute;
                    bottom: 5%;
                    left: 0;
                    background: var(--dashboard-color);
                }

                &:is(.active) {

                    &::after {
                        top: 50%;
                        bottom: 0%;
                        transition: all .5s ease-in-out;
                        transform: rotate(-45deg);
                    }

                    &::before {
                        top: 50%;
                        transform: rotate(45deg);

                    }

                    .bar {
                        transition: all .5s ease-in-out;

                        transform: rotate(90deg);
                        opacity: 0;
                        visibility: hidden;

                    }

                }

                .bar {
                    transition: all .5s ease-in-out;
                    border-radius: 10px;
                    width: 100%;
                    height: 3px;
                    background: var(--dashboard-color);

                }
            }
        }

    }

    small {
        font-size: 20px;
        border-radius: 10px;
        width: auto;
        height: 80%;
        display: flex;
        align-items: center;

        span {
            padding: 6px;
            color: var(--dashboard-color);

        }
    }

    .WelcomeText {
        font-size: 15px;
        color: var(--dashboard-color);
        font-weight: 900;
        padding: 1rem;

    }

}

@media screen and (max-width:768px) {

    .nav {

        .container {
            .WelcomeText {
                font-size: 12px;
                font-weight: 900;
                padding: .5rem;


            }

            .info {
                border: none;
                justify-content: space-evenly;

                span {
                    display: none;
                }

                .hamburger {
                    display: flex;
                }
            }


        }

        small {
            font-size: 12px;

            span {
                padding: 2px;
            }
        }
    }

}

@media screen and (max-width:330px) {

    .nav {

        .container {
            .WelcomeText {
                font-size: 9px;
                font-weight: 900;
                padding: .1rem;
            }

            .info {
                border: none;

                span {
                    display: none;
                }

                .user {
                    width: 35px;
                    height: 35px;
                    padding: 1px;
                    margin: 0 .5rem;
                }

                .hamburger {
                    display: flex;
                    width: 20px;
                    height: 15px;
                }
            }


        }

        small {
            font-size: 12px;

            span {
                padding: 3px;
            }
        }
    }

}
</style>