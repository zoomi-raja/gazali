import {getItem} from '../utilities/localState'

const header= {
    'Authorization':getItem('auth_token')
}
export default header