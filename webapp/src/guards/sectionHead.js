import router from "@/router";

// to, from, next
const guard = (to, from, next) => {


    if (localStorage.getItem('token') !== null || localStorage.getItem('role') !== null) {
        if (localStorage.getItem('completed') == 'true') {
            if (localStorage.getItem('role') == 'section_head') {
                next();
            } else {
                router.replace('/access-denied')
            }

        } else {

            router.replace('/account-complete')
        }
    } else {
        next('/');

    }


}

export default guard