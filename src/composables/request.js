import axios from "axios";

export const request = (method, url, data={}, useToken= true, partialurl= true) => {
    return axios({
        method: method,
        url: partialurl ? import.meta.env.VITE_BASE_URI + url : url,
        data: data,
        headers: {
            Authorization: useToken ? "Bearer " + localStorage.getItem("toto") : ""
        }
    })
}