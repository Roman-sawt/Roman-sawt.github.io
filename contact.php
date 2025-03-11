<?php include('Template/Main/header.php')?>

    <main>
        <section class="contacts-section">
            <div class="contacts-container">
                <!-- Title -->
                 <div class="contacts-header">
                    <h1><i class="fas fa-map-marker-alt"></i> Свяжитесь с нами</h1>
                    <p>Мы готовы обсудить ваш проект в любое время</p>
                 </div>

                <!-- main content -->
                 <div class="contacts-content">
                    <!-- info -->
                     <div class="contact-info">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            
                            <div class="info-text">
                                <h3>Телефон</h3>
                                <a href="tel:+79991234567">+7 (999) 123-45-67</a>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <div class="info-text">
                                <h3>Email</h3>
                                <a href="mailto:info@cinecraft.ru">info@cinecraft.ru</a>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>    
                            <div class="info-text">
                                <h3>Часы работы</h3>
                                <p>Пн-Пт: 10:00 - 19:00</p>
                                <p>Сб-Вс: По договоренности</p>
                            </div>
                        </div>

                        <div class="social-links">
                            <h3>Социальные сети</h3>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-vk"></i></a>
                                <a href="#"><i class="fab fa-telegram"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-discord"></i></a>
                            </div>
                        </div>
                     </div>
                    
                    <!-- Form & Map -->
                     <div class="contact-interactive">
                        
                        <form class="contact-form" id="applicationForm">
                            <div class="form-group">
                                <input type="text" name="name" required>
                                <label>Ваше имя</label>
                                <span class="form-highlight"></span>
                            </div>

                            <div class="form-group">
                                <input type="email" name="email" required>
                                <label>Ваш Email</label>
                                <span class="form-highlight"></span>
                            </div>

                            <div class="form-group">
                            <textarea rows=5 name="description" required ></textarea>
                                <label>Сообщение</label>
                                <span class="form-highlight"></span>
                            </div>

                            <button type="submit" class="submit-btn">
                                <i class="fas fa-paper-plane"></i> Отправить
                            </button>
                        </form>

                        <!-- Map -->
                        <div class="contact-map">
                            <iframe 
                                src="https://yandex.ru/map-widget/v1/?um=constructor%3A..." 
                                frameborder="0"
                                loading="lazy"
                                allowfullscreen>
                            </iframe>
                        </div>
                     </div>
                 </div>
            </div>
        </section>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applicationForm = document.getElementById('applicationForm');

            applicationForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('vendor/submit_application.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Ошибка сети');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        applicationForm.reset(); 
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                    alert('Произошла ошибка при отправке формы');
                });
            });
        });
    </script>
<?php include('Template/Main/footer.php')?>