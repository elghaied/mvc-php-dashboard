
import axios from 'https://cdn.skypack.dev/axios';

export default class APIClient {
 
    static baseURL = '/api';

    static getCarList() {
        return axios.get(`${this.baseURL}/getCarList`)
            .then(response => response.data.cars)
            .catch(error => {
                console.error('Error fetching car list:', error);
                throw error;
            });
    }

    static getCarById(carId) {
        return axios.get(`${this.baseURL}/car/${carId}`)
            .then(response => response.data)
            .catch(error => {
                console.error('Error fetching car details:', error);
                throw error;
            });
    }

    static updateCar(carId, updatedData) {
        return axios.post(`${this.baseURL}/updateCar/${carId}`, updatedData , {
            headers: {
                'Content-Type': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',

            },
        }) 
            .then(response => {
                console.log('Car updated successfully:', response.data);
                return response.data;
            })
            .catch(error => {
                console.error('Error updating car:', error);
                throw error;
            });
    }

    static deleteCar(carId) {
        return axios.get(`${this.baseURL}/deleteCar/${carId}`)
            .then(response => {
                console.log('Car deleted successfully:', response.data);
                return response.data;
            })
            .catch(error => {
                console.error('Error deleting car:', error);
                throw error;
            });
    }

    // Add car
    static addCar(car) {
        return axios.post(`${this.baseURL}/add`, car, {
            headers: {
                'Content-Type': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': 'application/json',

            },
        })
            .then(response => {
                
                return response.data;
            })
            .catch(error => {
                console.error('Error adding car:', error);
                throw error;
            });
    }

}
