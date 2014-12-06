function ChangeImage(src, target) {
	var image = document.getElementById(target);
	image.src = src;
	console.log('ChangeImage, src: ' + src + ', target: ' + target); 
	//console.log('var image: ' + image);
	//console.log('ChangeImage, ')
}