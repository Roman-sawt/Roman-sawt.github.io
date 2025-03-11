<?php session_start(); ?>
<?php require 'function.php' ?>
<?php $currentPage = $_SERVER['REQUEST_URI'];
              $menuItems = getMenuItems(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Template.css">
    <link rel="stylesheet" href="css/page/main.css">
    <link rel="stylesheet" href="css/page/forms_style.css">
    <link rel="stylesheet" href="css/page/store_style.css">
    <link rel="stylesheet" href="css/page/about_style.css">
    <link rel="stylesheet" href="css/page/contact_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <script src="Template/cart_script.js"></script>
    <header>
        <div class="header-content">
            <a href="/" class="logo">CineCraft</a>
            
            <div class="burger-menu" id="burgerMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav>
                <ul class="nav-menu"  id="navMenu">
                    <?php
                        foreach ($menuItems as $item) {
                            $activeClass = ($currentPage == $item['url']) ? 'active' : '';
                            echo "<li><a href='{$item['url']}' class='nav-link $activeClass'>{$item['title']}</a></li>";
                        }
                    ?>
                </ul>
            </nav>

            <div class="header-actions">
                <a href="#cart" class="header-icon" id="cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <a href="#login" class="header-icon" id="loginLink">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>

    </header>   


    <!-- Modal view Cart -->
    <div id="cartModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Корзина</h2>
            <div id="cart-content">
                <!-- Содержимое корзины будет загружено сюда -->
            </div>
            <div class="cart-total">
                <strong>Итого:</strong> <span id="cart-total">0</span> ₽
            </div>
            <button id="checkoutButton" class="submit-btn">Оформить заказ</button>
        </div>
    </div>

    <!-- Modal view LK -->
    <div id="userCabinetModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Личный кабинет</h2>
            <div id="userInfo">
                <!-- load user data -->
            </div>
            <div id="userOrders">
                <h3>Ваши заказы</h3>
                <div id="ordersList"></div>
            </div>
            <button id="logoutButton" class="submit-btn">Выйти</button>
        </div>
    </div>


    <!-- Modal view -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Авторизация</h2>
            <!-- action="login.php" -->
            <form id="loginForm">
                <div class="input-group">
                    <input type="text" id="login" name="login" required>
                    <label for="login">
                        <i class="fas fa-user"></i> Логин
                    </label>
                    <div class="highlight"></div>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" required>
                    <label for="password">
                        <i class="fas fa-lock"></i> Пароль
                    </label>
                    <div class="highlight"></div>
                </div>
                <button type="submit" class="submit-btn">Войти</button>
            </form>
            <div class="auth-links">
                <a href="#register" id="registerLink">Зарегистрироваться</a>
                <a href="#forgot-password" id="forgotPasswordLink">Забыли пароль?</a>
            </div>
            <div id="loginMessage"></div>
        </div>
    </div>

    <!-- Modal view recovery account -->
    <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Восстановление пароля</h2>
            <!-- action="forgot_password.php" -->
            <form id="forgotPasswordForm">
                <div class="input-group">
                    <input type="email" id="forgot-email" name="email" required>
                    <label for="forgot-email">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <div class="highlight"></div>
                </div>
                <button type="submit" class="submit-btn">Отправить</button>
            </form>
            <div class="auth-links">
                <a href="#login" id="backToLoginLink">Вернуться к авторизации</a>
            </div>
            <div id="forgotPasswordMessage"></div>
        </div>
    </div>

    <!-- Modal view registration -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Регистрация</h2>
            <!-- action="register.php" -->
            <form id="registerForm">
                <div class="input-group">
                    <input type="text" id="name" name="name" required>
                    <label for="name">
                        <i class="fas fa-user"></i> Имя
                    </label>
                    <div class="highlight"></div>
                </div>
                <div class="input-group">
                    <input type="text" id="register-login" name="login" required>
                    <label for="register-login">
                        <i class="fas fa-user"></i> Логин
                    </label>
                    <div class="highlight"></div>
                </div>
                <div class="input-group">
                    <input type="password" id="register-password" name="password" required>
                    <label for="register-password">
                        <i class="fas fa-lock"></i> Пароль
                    </label>
                    <div class="highlight"></div>
                </div>
                <button type="submit" class="submit-btn">Зарегистрироваться</button>
            </form>
            <div class="auth-links">
                <a href="#login" id="backToLoginFromRegisterLink">Вернуться к авторизации</a>
            </div>
            <div id="registerMessage"></div>
        </div>
    </div>