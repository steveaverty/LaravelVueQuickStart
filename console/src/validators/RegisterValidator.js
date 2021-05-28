import {required, email, sameAs} from 'vuelidate/lib/validators'

export default {
    email: {
        required, email
    },
    name: {
        required
    },
    password: {
        required
    },
    password_confirmation: {
        sameAsPassword: sameAs('password')
    },
    cgu : {
        sameAs: sameAs( () => true )
    }


}
