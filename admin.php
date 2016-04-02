<!doctype html>
<html>
    <meta charset="utf-8">
	<head>
	    <link href="style.css" rel="stylesheet">
	    <link href="foundation.css" rel="stylesheet">
	    <script type="text/javascript" src="jquery.js"></script>
	    <script type="text/javascript" src="foundation.min.js"></script>
		<TITLE></TITLE>
	</head>
	<body>
		<div class="main">
		<h2 class="text-center">Добавить событие</h2>

		<form method="POST" name="form1">
		<div class="text-center">
		    <input type="radio" name="times" id="pokemonRed"><label for="pokemonRed">млрд.</label>
            <input type="radio" name="times" id="pokemonBlue"><label for="pokemonBlue">млн.</label>
            <input type="radio" name="times" id="pokemonBlue"><label for="pokemonBlue">По умолчанию</label>
            </div>
		    
		    <!--<p>Когда произошло событие</p>
		    <p><label><input type="radio" name="veha">13,7 - 4,8 млрд. лет до н.э.</label> </p>
		    <p><label><input type="radio" name="veha">4,8 - 4,6 млрд. лет до н.э.</label></p>

		    <p><label><input type="radio" name="veha">4,6 млрд. лет до н.э. - 3 млн. лет до н.э.</label></p> 
		    <p><label><input type="radio" name="veha">3 млн. лет до н.э. - 5000 лет до н.э.</label></p>

		    <p><label><input type="radio" name="veha">5000 лет до н.э. - Начало нашей эры</label></p> 
		    <p><label><input type="radio" name="veha">Начало нашей эры - 500 г. н.э.</label></p>

		    <p><label><input type="radio" name="veha">500г. - 1000г.</label></p> 
		    <p><label><input type="radio" name="veha">1000г. - 1500г.</label class="right"></p>

		    <p><label><input type="radio" name="veha">1500г. - 2000г.</label></p>
		    <p><label><input type="radio" name="veha">2000г. - 2016г.</label></p>

		    <select name="century">
		    <option>1 век нашей эры</option>
		    <option>2 век нашей эры</option>
		    <option>3 век нашей эры</option>
		    <option>4 век нашей эры</option>
		    <option>5 век нашей эры</option>
		    <option>6 век нашей эры</option>
		    <option>7 век нашей эры</option>
		    <option>8 век нашей эры</option>
		    <option>9 век нашей эры</option>
		    <option>10 век нашей эры</option>
		    <option>11 век нашей эры</option>
		    <option>12 век нашей эры</option>
		    <option>13 век нашей эры</option>
		    <option>14 век нашей эры</option>
		    <option>15 век нашей эры</option>
		    <option>16 век нашей эры</option>
		    <option>17 век нашей эры</option>
		    <option>18 век нашей эры</option>
		    <option>19 век нашей эры</option>
		    <option>20 век нашей эры</option>
		    <option>21 век нашей эры</option>
		    </select>-->
		    <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Год события</label>
                </div>
                <div class="small-9 columns">
                  <input type="text" id="middle-label" name="year" required>
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Название</label>
                </div>
                <div class="small-9 columns">
                  <input type="text" id="middle-label" name="nameEvent" required>
                </div>
            </div>
            <!--<p><label>Название события <input type="text" name="nameEvent" required></label></p>-->
            <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Oписание</label>
                </div>
                <div class="small-9 columns">
                  <textarea name="description" rows="10" cols="15" id="middle-label" required></textarea>
                </div>
            </div>
            <!--<p>Oписание события</p> 
            <textarea name="description" rows="10" cols="15" required></textarea>
            <p>-->
            <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Изображение</label>
                </div>
                <div class="small-9 columns">
                  <label for="exampleFileUpload" class="button secondary">Обзор...</label><input type="file" accept="image/*" name="photo" id="exampleFileUpload" class="show-for-sr" required>
                </div>
            </div>
            <!--<label for="exampleFileUpload" class="button secondary">Добавить изображение</label><input type="file" accept="image/*" name="photo" id="exampleFileUpload" class="show-for-sr" required></p>-->
            <div class="row">
                <div class="small-3 columns">
                  <label for="middle-label" class="text-right middle">Ccылка на видео</label>
                </div>
                <div class="small-9 columns">
                  <input type="text" name="video" required>
                </div>
            </div>
            
            <!--<p><label>Вставить ссылку на видео<input type="text" name="video" required></label></p>-->
            <div class="text-center">
            <input type="submit" name="butt" value="Отправить" class="button" id="middle-label">
            </div>
        </form>
        </div>
	</body>
</html>