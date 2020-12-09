# CodeIgniter 3 Room Library

Shape is library to help you make a views easily, Shape is a view that rendered before called by other Shape / View

How to install this Library 
- Download this project
- Move Shape.php to your-codeigniter-project-folder/application/library
- Open your-codeigniter-project-folder/application/config/autoload.php
- Add 'room' to $autoload['libraries']
- Then you can use the Room !

# Documentation

### Declare a room
```sh
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>
<?=$room->declare('content')?>
</body>
</html>
```
The declare method only have one argument - the name of room, That way any child views know what to name the opened room .

### Extend a view
```sh
<?=$room->extend('welcome')?>
```
You must put the extend after all room has opened

### Open & close Room
```sh
<?=$room->open('content')?>
Hello World
<?=$room->close()?>
```
The open method only have one argument - the name of room, and close method dont need any argument. That way any room with similiar name to parent view will be replaced
```sh
<?=$room->open('content')?>
Hello World
<?=$room->close()?>

<?=$room->extend('welcome')?>
```

### Rendering the view with Room
if you don't change the name of library :
```sh
public function index(){
  $this->room->load('content');
}
```

if you want to pass a data to View :
```sh
public function index(){
  $data = [
    'hello': "World"
  ];
  $this->room->load('content', $data);
}
```

### Access data in room
In CI3 native, you'll access data with $hello, but we must using a different way 
```sh
<?=$room->open('content')?>
Hello <?=$room->data('hello')?>
<?=$room->close()?>

<?=$room->extend('welcome')?>
```

### Including room partials
Room partials is make a new viewm, this code similiar feature to Rendering view
h1.html
```sh
<h1>Title For website</h1>
```
content.html
```sh
<?=$room->open('content')?>
<?=$room->include('h1')?>
<?=$room->close()?>

<?=$room->extend('welcome')?>
```
If you are include a view, the new view will have different data so you can passing data from content.html to h1.html
h1.html
```sh
<h1><?=$room->data('title')?></h1>
```
content.html
```sh
<?=$room->open('content')?>
<?=$room->include('h1', ['title=>"Title For website"])?>
<?=$room->close()?>

<?=$room->extend('welcome')?>
```


### Todos

 - More efficient & effective code
 - Data conditional rendering
 - 

License
----

MIT


### Don't hesitate to contact me if you need help
Email : ichsann.saidd@gmail.com

Instagram : said_nrs

Facebook : https://www.facebook.com/telorjan/

Because my english is so bad, i think i only accept project from indonesian people :(





