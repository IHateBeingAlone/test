function updateButton(input, count) {
    const button = input.closest('.item').querySelector('.item-cart')

    button.dataset.count = count
}

function checkInput(input, value) {
    if (value > 999) {
        input.value = 999
        updateButton(input, 999)
    } else if (value < 1) {
        input.value = 1
        updateButton(input, 1)
    } else {
        input.value = value
        updateButton(input, value)
    }
}

function itemEvent(button, type) {
    const input = button.closest('.item-count').querySelector('input')

    button.addEventListener('click', () => {
        const value = type == 'plus' ? parseInt(input.value) + 1 : parseInt(input.value) - 1
        checkInput(input, value)
    })
}

function openModal(data) {
    const modal = document.querySelector('.modal')
    modal.classList.remove('-success')
    document.querySelector('body').classList.add('-modal')
    if (window.innerWidth > 1000) {
        document.querySelector('body').classList.add('-anti-jump')
    }

    modal.querySelector('.modal-item__image').src = data.src
    modal.querySelector('.modal-item__name').innerHTML = data.name
    modal.querySelector('.modal-item__cost').innerHTML = `${(data.price * data.count).toLocaleString('ru')} ₽`
    modal.querySelector('.modal-item__price').innerHTML = `${data.price.toLocaleString('ru')} ₽`
    modal.querySelector('.modal-item__count').innerHTML = `${data.count} шт`
    const modalForm = modal.querySelector('form')
    modalForm.dataset.item = `${data.name}, ${data.count} шт, стоимость: ${data.price.toLocaleString('ru')} ₽, сумма: ${(data.price * data.count).toLocaleString('ru')} ₽`
    modalForm.querySelectorAll('input').forEach((input) => {
        input.value = ''
    })
    modalForm.querySelectorAll('textarea').forEach((input) => {
        input.value = ''
    })
    modalForm.classList.remove('-error')

    modal.classList.add('-active')
}

function closeModal(selector) {
    const modal = document.querySelector('.modal')

    document.querySelector(selector).addEventListener('click', () => {
        modal.classList.remove('-active')
        document.querySelector('body').classList.remove('-modal')
        document.querySelector('body').classList.remove('-anti-jump')
    })
}

function itemsLogic() {
    const items = document.querySelectorAll('.item')

    items.forEach((item) => {
        const input = item.querySelector('.item-count__input')
    
        itemEvent(item.querySelector('[data-count="plus"]'), 'plus')
        itemEvent(item.querySelector('[data-count="minus"]'), 'minus')
    
        input.addEventListener('change', () => {
            if (!input.value.length > 0) {
                input.value = 1
                updateButton(input, 1)
            }
        })
    
        input.addEventListener('input', () => {
            if (input.value.length > 0) {
                checkInput(input, parseInt(input.value))
            }
        })
    })
}

function itemsCartLogic() {
    document.querySelectorAll('.item-cart').forEach((item) => {
        item.addEventListener('click', (event) => {
            const itemName = event.target.closest('.item').querySelector('.item-name').innerHTML
            const itemImage = event.target.closest('.item').querySelector('.preview').src
            const itemCount = event.target.dataset.count
            const itemPrice = event.target.dataset.price
    
            const data = {src: itemImage, name: itemName, count: parseInt(itemCount), price: parseInt(itemPrice)}
    
            openModal(data)
        })
    })
}

function isValidPhone(phone) {
    return phone.length == 11
}

function modalAjax() {
    const modalForm = document.querySelector('.modal-form')

    modalForm.addEventListener('submit', function(event) {
        event.preventDefault()

        const formData = new FormData(modalForm)

        const nameValue = formData.get('name')
        const phoneValue = formData.get('phone')
        const messageValue = formData.get('message')

        modalForm.classList.remove('-error')

        if (isValidPhone(phoneValue.replace(/\W|_/g, ''))) {
            const request = new XMLHttpRequest()
        
            const url = "ajax.php"
            
            request.open("POST", url, true)
            
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
            
            request.addEventListener("readystatechange", () => {
                if(request.readyState === 4 && request.status === 200) {
                    const data = JSON.parse(request.responseText)
                    const debug = document.querySelector('.debug')
                    debug.classList.add('-active')
                    debug.querySelector('.debug__name').innerHTML = `Имя: ${data.name}`
                    debug.querySelector('.debug__phone').innerHTML = `Телефон: ${data.phone}`
                    debug.querySelector('.debug__message').innerHTML = `Комментарий: ${data.message}`
                    debug.querySelector('.debug__item').innerHTML = `Товар: ${data.item}`
                    debug.querySelector('.debug__url').innerHTML = `Адрес страницы: ${data.url}`
                    debug.querySelector('.debug__ip').innerHTML = `IP адрес: ${data.ip}`

                    modalForm.closest('.modal').classList.add('-success')
                }
            })

            fetch('https://api.ipify.org?format=json').then(res => res.json()).then(data => {
                const params = `name=${nameValue}&phone=${phoneValue}&message=${messageValue}&item=${modalForm.dataset.item}&url=${window.location.href}&ip=${data.ip}`
                request.send(params)
            });
        } else {
            modalForm.classList.add('-error')
        }
    })
}

function masks() {
    const phoneList = document.querySelectorAll('.mask__phone');
    if (!phoneList) return;

    const maskPhone = {
        mask: '+{7} (000) 000-00-00',
    };

    phoneList.forEach((phone) => {
        let mask = IMask(phone, maskPhone);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    itemsLogic()
    itemsCartLogic()
    masks()
    closeModal('.modal-background')
    closeModal('.modal-close')
    modalAjax()
});