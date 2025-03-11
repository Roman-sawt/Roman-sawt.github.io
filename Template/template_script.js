document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        } else {
            console.error('Элемент не найден:', this.getAttribute('href'));
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.getElementById('burgerMenu');
    const navMenu = document.getElementById('navMenu');

    burgerMenu.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        burgerMenu.classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        if (!navMenu.contains(event.target) && !burgerMenu.contains(event.target)) {
            navMenu.classList.remove('active');
            burgerMenu.classList.remove('active');
        }
    });
});


// Open modal views
document.getElementById('loginLink').addEventListener('click', function (e) {
    e.preventDefault();
    openModal('loginModal');
});

document.getElementById('registerLink').addEventListener('click', function (e) {
    e.preventDefault();
    openModal('registerModal');
});

document.getElementById('forgotPasswordLink').addEventListener('click', function (e) {
    e.preventDefault();
    openModal('forgotPasswordModal');
});

document.getElementById('backToLoginFromRegisterLink').addEventListener('click', function (e) {
    e.preventDefault();
    openModal('loginModal');
});

document.getElementById('backToLoginLink').addEventListener('click', function (e) {
    e.preventDefault();
    openModal('loginModal');
});


// Close modal view about view
document.querySelectorAll('.close-modal').forEach(function (closeBtn) {
    closeBtn.addEventListener('click', function () {
        closeAllModals();
    });
});

window.addEventListener('click', function (e) {
    if (e.target.classList.contains('modal')) {
        closeAllModals();
    }
});

function openModal(modalId) {
    closeAllModals(); 
    document.getElementById(modalId).style.display = 'block';
}

function closeAllModals() {
    document.querySelectorAll('.modal').forEach(function (modal) {
        modal.style.display = 'none';
    });
}

// Method AJAX for login
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/vendor/auth.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeAllModals(); 
            loadUserCabinet(); 
            openModal('userCabinetModal'); 
        } else {
            document.getElementById('loginMessage').textContent = data.message;
        }
    });
});

// Load lk
function loadUserCabinet() {
    fetch('/vendor/getUserData.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('userInfo').innerHTML = `
                    <div>Ваш ID: ${data.user.id_user}</div>
                    <div>Ваше имя: ${data.user.name}</div>
                    <div>Ваш логин: ${data.user.login}</div>`;
            } else {
                document.getElementById('userInfo').textContent = 'Ошибка загрузки данных';
            }
        });

    fetch('/vendor/get_orders.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const ordersList = document.getElementById('ordersList');
                ordersList.innerHTML = '';

                data.orders.forEach(order => {
                    const orderHTML = `
                        <div class="order-item">
                            <div><strong>Название проекта:</strong> ${order.project_name}</div>
                            <div><strong>Тип ролика:</strong> ${order.video_type}</div>
                            <div><strong>Длительность:</strong> ${order.duration} сек.</div>
                            <div><strong>Срок:</strong> ${order.deadline}</div>
                            <div><strong>Статус:</strong> В обработке</div>
                        </div>
                    `;
                    ordersList.insertAdjacentHTML('beforeend', orderHTML);
                });
            } else {
                alert(data.message);
            }
        });
}


// Logout
document.getElementById('logoutButton').addEventListener('click', function () {
    fetch('/vendor/logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeAllModals();
                window.location.reload();
            }
        });
});

// Method AJAX for registration
document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/vendor/createUser.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('registerMessage').textContent = data.message;
        } else {
            document.getElementById('registerMessage').textContent = data.message;
        }
    });
});

// Method AJAX for recovery
document.getElementById('forgotPasswordForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/vendor/forgotPassword.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('forgotPasswordMessage').textContent = data.message;
    });
});



