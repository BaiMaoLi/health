<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Audio Recorder</title>

	
	<script src="js/recorderjs/recorder.js"></script>
	<script src="js/audiodisplay.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<div id="viz">
		<canvas id="analyser" width="400" height="200"></canvas>
		<canvas id="wavedisplay" width="400" height="200"></canvas>
	</div>
	<div id="controls">
		<img id="record" src="img/mic128.png" onclick="toggleRecording(this);">
		<a id="save" href="#"><img src="img/save.svg"></a>
	</div>

</body>
</html>