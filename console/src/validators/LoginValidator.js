import {required, email} from 'vuelidate/lib/validators'

export default {
    email: {
        required, email
    },
    password: {
        required
    }
}