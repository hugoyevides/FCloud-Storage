function delFile(fileName){
		swal("Peligro!","El achivo " + fileName + " no se podra recuperar, deseas continuar?",{
			buttons:{
				cancel: "No!" ,
				yes: {
					text: "Si",
					value: "continue",
				}
			},
			icon: "warning",
		},)
		.then((value)=>{
			switch(value){
				case "continue":
					//Call php sript to delete the file
					//location.href="download.php?fileName="+fileName;
					break;
				default:
					swal("Tu archivo esta seguro!","El archivo no fue eliminado!","info");
					break;
			}
		});
}
