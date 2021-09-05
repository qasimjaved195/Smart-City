<html>
<head>
	<meta charset="UTF-8">
	<title>3D Water Tank</title>
	<script src="push.js"></script>
	<script src="serviceWorker.min.js"></script>
</head>
<body>
<style>
.wrap{
	font-family: Roboto;
	text-align: center;
}
.tank{
	margin:0 50px;
	display: inline-block;
}
body{
	/*background: #eee;*/
	margin: 0;
}
</style>
<div class="wrap">
	<div class="tank waterTankHere1"></div>
	
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="waterTank.js"></script>
<script>
	
$(document).ready(function() {
	
	wtank("0");
	setInterval(function(){
 fetch_data();
}, 100);
    function wtank(val){
        $('.waterTankHere1').waterTank({
		width: 300,
		height: 350,
		color: '#8bd0ec',
		level: parseInt(val)
	});
	}
	function fetch_data()
	{
		var action = "fetch_data";
		$.ajax({
		url:"client.php",
		method:"POST",
		data:{action:action},
		success:function(data)
		{
			// var min=8;
			// var max=3
			// var final = 100/(min-max);
			// var final1 = (parseFloat(data)-2)*final;
			// if (data >= 90) {
			// 	Push.create("Hello world!");
			// }
		wtank(data);
		}
		});
	}
});

</script>
</body>
</html>
