<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYPZA PASTE</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
        }
        .banner {
            text-align: center;
            background-color: #252525;
            padding: 20px; /* Высота баннера */
            font-size: 24px; /* Размер шрифта баннера */
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .menu-toggle {
            position: absolute;
            top: 20px; /* Отступ сверху */
            left: 20px; /* Отступ слева */
            cursor: pointer;
            font-size: 24px; /* Увеличиваем размер иконки */
        }
        .menu {
            display: none; /* Скрываем меню по умолчанию */
            position: fixed; /* Фиксированное положение */
            top: 0; /* Отступ сверху */
            left: 0; /* Отступ слева */
            width: 250px; /* Ширина меню */
            height: 100%; /* Высота меню */
            background-color: #252525; /* Фон меню */
            padding: 20px; /* Отступы внутри меню */
            box-shadow: 2px 0 5px rgba(0,0,0,0.5); /* Тень для меню */
        }
        .menu a {
            display: block; 
            color: white; 
            text-decoration: none; 
            margin-bottom: 10px; 
        }
        .container {
            width: 90%;
            max-width: 400px; /* Максимальная ширина контейнера */
            background-color: #131313;
            border-radius: 10px;
            padding: 20px; /* Отступы внутри контейнера */
            margin: 20px auto; /* Центрируем контейнер */
        }
        .content {
            border-radius: 5px;
            background-color: #1c1c1c;
            padding: 20px; /* Отступы внутри контента */
        }
        .content h3 {
            font-size: 18px; /* Размер заголовка контента */
            margin: 0 0 10px 0;
        }
        .paste {
            background-color: #252525;
            border-radius: 5px;
            padding: 10px; /* Отступы внутри пасты */
            margin-bottom: 20px; /* Отступ снизу пасты */
        }
        .paste p {
            margin: 5px 0;
            font-size: 14px; /* Размер шрифта текста в пасте */
        }
        .btn {
            display: block;
            background-color: #2a2a2a;
            color: #fff;
            text-align: center;
            padding: 10px; /* Отступы внутри кнопки */
            border-radius: 5px; 
            cursor: pointer;
            text-decoration: none;
            font-size: 14px; /* Размер шрифта кнопки */
        }
        .btn:hover {
            background-color: #404040; 
        }
        /* Модальное окно */
        #popup {
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.85); /* Темный фон с прозрачностью */
            display: none; 
            justify-content: center; 
            align-items: center; 
        }
        #popup-content {
           background-color:#1c1c1c; 
           border-radius :10px; 
           padding :15px; 
           max-width :600px; /* Увеличиваем ширину модального окна */
           width :90%; 
           text-align:left; /* Выравнивание текста в модальном окне влево */
           margin-left :10px; /* Сдвигаем текст немного вправо для лучшего выравнивания */
       } 
       #popup pre {
           overflow-x:auto; 
           max-height :400px; /* Ограничиваем максимальную высоту для прокрутки */
           overflow-y:auto; /* Включаем вертикальную прокрутку при необходимости */
           padding :10px; 
           white-space :pre-wrap; 
           word-wrap :break-word; 
           border :1px solid #353535; 
       } 
       #popup .close-btn { 
           margin-top :15 px; 
           background-color :#2a2a2a; 
           text-decoration :none; 
           padding :20 px; /* Увеличиваем высоту кнопки */
           border-radius :5 px; 
           color:#fff; 
           cursor:pointer; 
           display:block; 
           text-align:center; 
           font-size :16 px; /* Увеличиваем размер шрифта кнопки */
       } 
       #popup .close-btn:hover { 
           background-color:#404040; 
       }  

       /* Адаптивные стили */
       @media (max-width: 600px) {
           .banner {
               font-size: 20px; /* Уменьшаем размер шрифта на мобильных устройствах */
           }
           .content h3 {
               font-size: 16px; /* Уменьшаем размер заголовка на мобильных устройствах */
           }
       }
   </style> 
</head> 

<body>

<div class="banner">SYPZA PASTE</div>
<div class="menu-toggle" onclick="toggleMenu()">☰</div>
<div class="menu" id="menu">
    <a href="https://t.me/sypza" target="_blank">Owner</a>
    <a href="https://t.me/sypzawave" target="_blank">Канал</a>
</div>

<div class="container">
    <div class="content">
        <h3>Доступные пасты:</h3>

        <?php
        $pasteDir = 'pastes/';
        $files = scandir($pasteDir);

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $content = file_get_contents($pasteDir . $file);
                $lineCount = substr_count($content, "\n");
                $date = date("d.m.Y", filemtime($pasteDir . $file)); // Получаем дату последнего изменения файла

                echo "<div class='paste'>";
                echo "<p><strong>$file</strong></p>";
                echo "<p>Строки: $lineCount</p>";
                echo "<p>Дата публикации: $date</p>";
                echo "<a href='#' class='btn' onclick='openPopup(`" . addslashes($content) . "`)'>ОТКРЫТЬ</a>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>

<div id="popup">
    <div id="popup-content">
        <pre id="popup-content-text"></pre>
        <a class="close-btn" onclick="closePopup()">Закрыть</a>
    </div>
</div>

<script>
    function openPopup(content) {
        document.getElementById('popup-content-text').textContent = content.replace(/`/g, ''); // Устанавливаем текст содержимого
        document.getElementById('popup').style.display = 'flex'; // Показываем модальное окно
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none'; // Скрываем модальное окно
    }

    function toggleMenu() {
        const menu = document.getElementById('menu');
        
        if (menu.style.display === 'block') {
             menu.style.display = 'none'; // Скрываем меню
             document.removeEventListener('click', closeMenuOnClickOutside); // Убираем обработчик события
         } else {
             menu.style.display = 'block'; // Показываем меню
             document.addEventListener('click', closeMenuOnClickOutside); // Добавляем обработчик события
         }
     }

     function closeMenuOnClickOutside(event) {
         const menu = document.getElementById('menu');
         const toggleButton = document.querySelector('.menu-toggle');

         if (!menu.contains(event.target) && !toggleButton.contains(event.target)) {
             menu.style.display = 'none'; // Скрываем меню при клике вне его области
             document.removeEventListener('click', closeMenuOnClickOutside); // Убираем обработчик события
         }
     }
</script>

</body>
</html>
