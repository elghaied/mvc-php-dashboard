import APIClient from './apiClient.js';


function elementExists(selector, useId = true) {
    if (useId) {
        return document.querySelector(`#${selector}`) !== null;
    } else {
        return document.querySelector(selector) !== null;
    }
}

const updateCarFormElement = elementExists('update-car-form') ? document.querySelector('#update-car-form') : null;
const addCarFormElement = elementExists('add-car-form') ? document.querySelector('#add-car-form') : null;
const popup = elementExists('popup') ? document.querySelector('#popup') : null;
const popupClose = elementExists('popup-close') ? document.querySelector('#popup-close') : null;
const carListContainer = elementExists('carListContainer') ? document.querySelector('#carListContainer') : null;
function showPopup() {
    if (popup) {
        popup.classList.remove('hidden');
        popup.classList.add('flex');
    }
}

function hidePopup() {
    if (popup) {
        popup.classList.add('hidden');
        popup.classList.remove('flex');
    }
}

if (popup && popupClose) {
    popupClose.addEventListener('click', () => {

        hidePopup();
    });
}


function updateCarForm(car) {

    if (updateCarFormElement && car) {
        updateCarFormElement.carId.value = car.id || '';
        updateCarFormElement.brand.value = car.brand || '';
        updateCarFormElement.model.value = car.model || '';
        updateCarFormElement.license_plate.value = car.license_plate || '';
        updateCarFormElement.price.value = car.price || '';
        updateCarFormElement.sale_type.value = car.sale_type || '';
        updateCarFormElement.reserved.checked = car.reserved === 1;
        updateCarFormElement.fuel.value = car.fuel || '';
    }
}

function addUpdateCarEventListener(element) {
    element.addEventListener('click', async () => {
        const carId = element.dataset.carid;
        try {
            const selectedCar = await APIClient.getCarById(carId);
            updateCarForm(selectedCar);
            console.log(selectedCar);
            showPopup();
        } catch (error) {
            console.error('Error:', error);
        }
    });
}

function addDeleteCarEventListener(element) {
    element.addEventListener('click', async () => {
        const carId = element.dataset.carid;
        try {
            const deletedCar = await APIClient.deleteCar(carId);
            renderCarList();
            console.log(deletedCar);
        } catch (error) {
            console.error('Error:', error);
        }
    });
}
async function renderCarList() {
    const carListHtml = await APIClient.getCarList();
    carListContainer.innerHTML = carListHtml;

    const carListUpdateButton = document.querySelectorAll('.update-car-button');
    const carListDeleteButton = document.querySelectorAll('.delete-car-button');
    carListUpdateButton.forEach(addUpdateCarEventListener);
    carListDeleteButton.forEach(addDeleteCarEventListener);
}

const carListUpdateButton = document.querySelectorAll('.update-car-button');
carListUpdateButton.forEach(addUpdateCarEventListener);

const carListDeleteButton = document.querySelectorAll('.delete-car-button');
carListDeleteButton.forEach(addDeleteCarEventListener);


updateCarFormElement && updateCarFormElement.addEventListener('submit', async (event) => {
    event.preventDefault();
    const carId = updateCarFormElement.carId.value;
    const updatedCar = {
        brand: updateCarFormElement.brand.value,
        model: updateCarFormElement.model.value,
        license_plate: updateCarFormElement.license_plate.value,
        price: updateCarFormElement.price.value,
        sale_type: updateCarFormElement.sale_type.value,
        reserved: updateCarFormElement.reserved.checked ? 1 : 0,
        fuel: updateCarFormElement.fuel.value,
    };
    console.log(updatedCar);

    try {
        const updatedCarData = await APIClient.updateCar(carId, updatedCar);
        renderCarList();
        hidePopup();
    } catch (error) {
        console.error('Error:', error);
    }
});

addCarFormElement && addCarFormElement.addEventListener('submit', async (event) => {
    event.preventDefault();
    const newCar = {
        brand: addCarFormElement.brand.value,
        model: addCarFormElement.model.value,
        license_plate: addCarFormElement.license_plate.value,
        price: addCarFormElement.price.value,
        sale_type: addCarFormElement.sale_type.value,
        reserved: addCarFormElement.reserved.checked ? 1 : 0,
        fuel: addCarFormElement.fuel.value,
    };
    console.log(newCar);

    try {
        const newCarData = await APIClient.addCar(newCar);

    } catch (error) {
        console.error('Error:', error);
    }
}   );