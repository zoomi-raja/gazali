const axios = require('axios')

class API {
    constructor({ url }){
        this.url = url
        this.endpoints = this.createBasicCRUDEndpoints()
    }

    createBasicCRUDEndpoints( ) {
        var endpoints = {}

        const resourceURL = `${this.url}`

        endpoints.getAll = ({ query={}}, config={} ) => axios.get(resourceURL, Object.assign({ params: { query }, config }))

        endpoints.get = ( config={} ) => axios.get(resourceURL, config)

        endpoints.getOne = ({ id }, config={}) =>  axios.get(`${resourceURL}/${id}`, config)

        endpoints.create = (toCreate, config={}) =>  axios.post(resourceURL, toCreate, config)

        endpoints.update = (toUpdate, config={}) => axios.put(`${resourceURL}/${toUpdate.id}`, toUpdate, config)

        endpoints.patch  = ({id}, toPatch, config={}) => axios.patch(`${resourceURL}/${id}`, toPatch, config)

        endpoints.delete = ({ id }, config={}) => axios.delete(`${resourceURL}/${id}`, config)

        return endpoints

    }

}

export default API