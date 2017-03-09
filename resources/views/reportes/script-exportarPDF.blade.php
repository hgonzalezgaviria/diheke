@section('scripts')
	{!! Html::script('assets/js/jquery/jquery.binarytransport.js') !!}
	{!! Html::script('assets/js/pdf/jspdf.min.js') !!}
	{!! Html::script('assets/js/pdf/jspdf.plugin.autotable.min.js') !!}

	<script type="text/javascript">

		function exportarPDF(modal) {
			try{
				var divCharts = $('.charts');

				//l = landscape ; p = portrait
				var pdf = new jsPDF('p', 'pt', 'letter');
				var totalPagesExp = "{total_pages_count_string}";
				//letter = 612x792 pt
				//https://www.gnu.org/software/gv/manual/html_node/Paper-Keywords-and-paper-size-in-points.html

				//Logo
				var imgLogo = null;
				var srcImgLogo = '{{ asset('assets/img/logo.jpeg') }}';
				var imgLogo = getBase64Image($('#logo')[0]);

				divCharts.each(function(index, elem) {
					//Header
					
					pdf.addImage(imgLogo, 'PNG', 480, 30, 100, 43.25);

					//Título
					pdf.setFont("helvetica");
					pdf.setFontType("bold");
					pdf.setFontSize(22);
					var title = $( this ).find('.panel-chart').find('.panel-heading');
					pdf.text(306, 60, title.text().trim(), null, null, 'center');

					//Gráfico
					var canvas = $( this ).find('canvas');
					var imgGraf = canvas[0].toDataURL('image/png');
					pdf.addImage(imgGraf, 'PNG', 50, 80);

					//Tabla
					var tablaDatos = $( this ).find('.tb-info');

					var data = pdf.autoTableHtmlToJson(tablaDatos[0]);
					var imgElements = tablaDatos[0].querySelectorAll('tbody img');
					var images = [];

					pdf.autoTable(data.columns, data.rows, {
						startY: 450,
						margin: {top: 50, right: 60, bottom: 50, left: 60},
						styles: {overflow:'linebreak', columnWidth:'wrap', cellPadding:10},
						//bodyStyles: {rowHeight: 30},
						columnStyles: {
							0: {columnWidth: 25},
							1: {columnWidth: 350}
						},
						drawCell: function(cell, opts) {
							if (opts.column.dataKey === 0 && opts.row.index < data.rows.length) {
								images.push({
								  elem: imgElements[opts.row.index],
								  x: cell.textPos.x,
								  y: cell.textPos.y
								});
							}
						},
						addPageContent: function(data) {
							for (var i = 0; i < images.length; i++) {
								if(!images[i].isLoad){
									pdf.addImage(images[i].elem, images[i].x, images[i].y-2, 20, 15);
									images[i].isLoad = true;
								}
							}

							//footer
					        pdf.setFontSize(10);
							pdf.setFontType("normal");
					        // Total page number plugin only available in jspdf v1.0+
					        var str = "Página " + data.pageCount;
					        if (typeof pdf.putTotalPages === 'function') {
					            str = str + " de " + totalPagesExp;
					        }

					        //pdf.text(str, data.settings.margin.left, pdf.internal.pageSize.height - 30);
					        pdf.text(50, 760, str);
							pdf.text(560, 760, '{{ \Carbon\Carbon::now()->format(Config::get('view.formatDateTime')) }}', null, null, 'right');
						}
					});

				    // Total page number plugin only available in jspdf v1.0+
				    if (typeof pdf.putTotalPages === 'function') {
				        pdf.putTotalPages(totalPagesExp);
				    }

					if(index != divCharts.length-1) {
						//Si no es el último chart, entonces insertar nueva página
						pdf.addPage();
					}
				});

				//save
				pdf.save('{{ 'ReporteEncuesta'.$ENCU_id.'.pdf' }}');
				modal.modal('hide')
			} catch (err) {
				alert(err.message);
			}
			
		};


		function getImage(data) {
			return html2canvas(data).then(function (canvas) {
				image = canvas.toDataURL("image/png");
				return image;
			})
			.catch(function (err) {
				console.log(err)
			});
		}


		function getElementImg(imgPath) {
			//var img = IEWIN ? new Image() : document.createElement('img');
			var img = new Image();
			img.onload = function() {
				return img;
			}
			img.crossOrigin = 'anonymous';
			img.src = imgPath;
		}

		// Code taken from MatthewCrumley (http://stackoverflow.com/a/934925/298479)
		function getBase64Image(img) {
			var dataURL = null;
			try{
				if(typeof img === 'string'){
					img = getElementImg(img);
				}

				// Create an empty canvas element
				var canvas = document.createElement('canvas');
				canvas.width = img.width;
				canvas.height = img.height;

				// Copy the image contents to the canvas
				var ctx = canvas.getContext('2d');
				ctx.drawImage(img, 0, 0);

				// Get the data-URL formatted image
				// Firefox supports PNG and JPEG. You could check img.src to guess the
				// original format, but be aware the using "image/jpg" will re-encode the image.
				dataURL = canvas.toDataURL();
			} catch(err) {
				console.log(err.message);
			}
			return dataURL;
		}

		// You could either use a function similar to this or pre convert an image with for example http://dopiaza.org/tools/datauri
		// http://stackoverflow.com/questions/6150289/how-to-convert-image-into-base64-string-using-javascript
		function imgToBase64(url, callback) {
			if (!window.FileReader) {
				callback(null);
				return;
			}
			var xhr = new XMLHttpRequest();
			xhr.responseType = 'blob';
			xhr.onload = function() {
				var reader = new FileReader();
				reader.onloadend = function() {
					callback(reader.result.replace('text/xml', 'image/jpeg'));
				};
				reader.readAsDataURL(xhr.response);
			};
			xhr.open('GET', url);
			xhr.send();
		}



		function getDataUri(url, callback) {
		    var image = new Image();

		    image.onload = function () {
		        var canvas = document.createElement('canvas');
		        canvas.width = this.naturalWidth; // or 'width' if you want a special/scaled size
		        canvas.height = this.naturalHeight; // or 'height' if you want a special/scaled size

		        canvas.getContext('2d').drawImage(this, 0, 0);

		        // Get raw image data
		        callback(canvas.toDataURL('image/png').replace(/^data:image\/(png|jpg);base64,/, ''));

		        // ... or get as Data URI
		        callback(canvas.toDataURL('image/png'));
		    };

		    image.src = url;
		}
	</script>
@parent
@endsection
