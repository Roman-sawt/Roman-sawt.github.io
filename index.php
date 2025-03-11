<?php include('Template/Main/header.php')?>
    <main>
        <section class="hero-banner">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">Оживим ваши идеи в движении</h1>
                    <p class="hero-subtitle">Профессиональное создание синематиков для игр, кино и рукламы</p>

                    <div class="hero-actions">
                        <a href="create_form.php" class="hero-btn primary">Заказать проект</a>
                        <a href="#gallery-anchor" class="hero-btn secondary">Смотреть работы</a>
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="visual-container">
                        <div class="gradient-effect"></div>
                        <img src="Template/Img/work1.jpg" alt="Пример работы" class="hero-preview">
                    </div>
                </div>
            </div>
        </section>

         
        <section class="stats-section">
            <div class="section-content">
                <h2 class="section-title">Мы в цифрах</h2>

                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number" data-count="150">0</div>
                        <div class="stat-string">Завершенных проектов</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="98">0</div>
                        <div class="stat-string">Довольных клиентов</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-count="500">0</div>
                        <div class="stat-string">Часов анимации</div>
                    </div>
                </div>
                <div id="gallery-anchor"></div>
            </div>
        </section>
  
        <section class="gallery-section">
            <div class="section-content">
                <h2 class="section-title">Примеры работ</h2>
                <div class="gallery-grid">
                    <div class="gallery-item">
                        <div class="item-overlay">
                            <div class="overlay-content">
                                <h3 class="work-title">Игровой трейлер</h3>
                                <p class="work-category">Экшен-игра</p>
                                <button class="btn-view">Подробнее</button>
                            </div>
                        </div>
                        <img src="Template/Img/work1.jpg" alt="Пример работы 1" class="work-image">
                    </div>
        
                    <div class="gallery-item">
                        <div class="item-overlay">
                            <div class="overlay-content">
                                <h3 class="work-title">Рекламный ролик</h3>
                                <p class="work-category">Косметика</p>
                                <button class="btn-view">Подробнее</button>
                            </div>
                        </div>
                        <img src="Template/Img/work1.jpg" alt="Пример работы 2" class="work-image">
                    </div>
                </div>
            </div>
        </section>


        <section class="cine-section">
        <h2 class="cine-section__title">Наши услуги</h2>
        <div class="cine-grid">
            <div class="cine-service">
                <i class="fas fa-video cine-service__icon"></i>
                <h3 class="cine-service__title">Игровые синематики</h3>
                <p class="cine-service__description">Создание захватывающих вступительных роликов и кат-сцен</p>
            </div>
            
            <div class="cine-service">
                <i class="fas fa-ad cine-service__icon"></i>
                <h3 class="cine-service__title">Рекламные ролики</h3>
                <p class="cine-service__description">Профессиональная видеореклама для бизнеса</p>
            </div>
        </div>
    </section>

    <section class="cine-section">
        <div class="cine-form">
            <h2 class="cine-section__title">Оставить заявку</h2>
            <form id="applicationForm">
                <div class="cine-form__group">
                    <input type="text" class="cine-form__input" placeholder="Ваше имя" 
                        name="name" required
                    >
                    <span class="cine-form__highlight"></span>
                </div>
                
                <div class="cine-form__group">
                    <input type="email" class="cine-form__input" placeholder="Ваш Email" 
                        name="email" required
                    >
                    <span class="cine-form__highlight"></span>
                </div>
                
                <div class="cine-form__group">
                    <textarea class="cine-form__textarea" placeholder="Описание проекта" 
                        name="description" required
                    ></textarea>
                    <span class="cine-form__highlight"></span>
                </div>
                
                <button type="submit" class="cine-btn cine-btn--primary">Отправить</button>
            </form>
        </div>
    </section>

    </main>


    <script>
        // Animation number
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-count');
                const duration = 2000;
                const step = target / (duration / 10);
                
                let current = 0;
                
                const updateCount = () => {
                    current += step;
                    if(current < target) {
                        counter.textContent = Math.ceil(current);
                        setTimeout(updateCount, 10);
                    } else {
                        counter.textContent = target;
                    }
                }
                
                updateCount();
            });
        });


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