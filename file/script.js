var ordered = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
var idx = 0;
var timed = false;

var now = new Date().getTime();
	var countDownDate = now + 300000;
	
	var countDown = setInterval(function() 
	{
	  now = new Date().getTime();  
	  var distance = countDownDate - now;
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
	  if (distance > 0  ) 
	  {
		if(seconds < 10)
			seconds = '0'+seconds;
		document.getElementById("timer").innerHTML = minutes + ":" + seconds;
	  }
	  else
	  {
		  document.getElementById("timer").innerHTML = "Waktu Habis";
		  clearInterval(countDown);
	  }
	}, 100);
$(document).ready(function()
{
	
	var order = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
	shuffle(order);
	
	//let list = document.getElementById("soalPage");
	for(var x=0;x<15;x++)
	{
		ordered[x] = order[x];
		//list.innerHTML += ordered[x] + '<br>';
	}
	soal(idx);
	
	$("#nextQ").on("click",function(chosen)
	{
		var len = document.getElementById("soal").choice.length;
	});
	setTimeout(function()
				{
					if(!timed)
					{
						alert("1 menit lagi");
						
					}
				},240000);
	setTimeout(TimeOut,301000);
	
	
});

function TimeOut()
{
	if(!timed)
	{
		alert("maaf waktu sudah habis");
		print();
	}
}

var jawaban =  ["x",  "x","x","x","x",   "x","x","x","x","x",   "x","x","x","x","x","x"];
var kunciJWB = ["x", "x","x","x","x",   "x","x","x","x","x",   "x","x","x","x","x","x"];
var keteranganKunci = ["x", "x","x","x","x",   "x","x","x","x","x",   "x","x","x","x","x","x"];
function dataJawaban(jwb,soal)
{
	jawaban[soal] = jwb;
	document.getElementById("buttonA").style = "background-color:#5ca9fb";
	document.getElementById("buttonB").style = "background-color:#5ca9fb";
	document.getElementById("buttonC").style = "background-color:#5ca9fb";
	document.getElementById("buttonD").style = "background-color:#5ca9fb";
	document.getElementById("button" + jwb).style = "background-color:green";
	
	document.getElementById("button"+ soal).style = "background-color:#5ca9fb";
}

function submitTest()
{
	var kelar = 1;
	
	for(var j = 1;j <= 15;j++)
	{
		if(jawaban[j] == 'x')
		{
			alert("Belum semua soal di jawab");
			kelar = 0;
			
			break;
		}
	}
	if(kelar == 1)
	{
		 var r = confirm("Yakin?");
		 if (r == true) 
		 {
			timed = true;
			clearInterval(countDown);
			print();
		 }
	}
}

function print()
{
	
	
	let warna;
	let hasil;
	let complete = '<div  id="accordion">';
	var nilai = 0;
	var lulus;
	for(var j = 1;j <= 15;j++)
	{
		if(jawaban[j] == 'x')
		{
			warna= 'style="background-color:red"';
			hasil = "tidak terjawab";
		}
		else if(jawaban[j] == kunciJWB[j])
		{
			warna= 'style="background-color:lightBlue"';
			hasil = j +'.'+jawaban[j];
			nilai++;
		}
		else
		{
			warna= 'style="background-color:red"';
			hasil = j +'.'+jawaban[j] +'('+kunciJWB[j]+')' ;
		}
		
		complete +=
					
					"<h3 "+warna+" >" +                  hasil                        + "</h3>" +
					"<div id='single'>" +
						"<p>" +
								keteranganJawaban(j - 1)+
						"</p>" +
					"</div>";
	}
	nilai = nilai / 15 * 10;
	if(nilai % 1 != 0)
		nilai = nilai.toFixed(2);
	if(nilai >= 5.5)
	{
		$("#team").html("<h1>SELAMAT</h1>");
		lulus = 'style="background-color:lightBlue"';
	}
	else
	{
		$("#team").html("<h1>semoga beruntung tahun depan</h1>");
		lulus = 'style="background-color:red"';
	}
	
	
	if(nilai % 1 == 0)
		nilai = nilai + '.0';
	var finalScore = '<button class="btn-custom4"  '+lulus+'>'+nilai+'</button> <br><br><br>';
	$("#soal").html(finalScore+complete + "</div>");
	$("#SubmitButton").html("");
	$("#bs-example-navbar-collapse-1").html("");				
					
	
	$("#accordion").accordion({
		active : false,
        animate: 200,
		collapsible: true
	});
}


function soal(count)
{
	
	if(count < 0 )
	{
		do{
			count += 15;	
		}while(count< 0)
	}
	else if(count > 14)
		count %= 15;
	
	
	var soal = ordered[count];
	
	let pertanyaan;
	let jawabA;
	let jawabB;
	let jawabC;
	let jawabD;
	let kunci;
	if (soal == 1)
	{
		pertanyaan = 'Faktor dari 48 adalah___';
		jawabA = '1, 2, 3, 5, 6, 8, 12, 24, 48';
		jawabB = '1, 2, 3, 4, 6, 7, 8, 24, 48';
		jawabC = '1, 2, 3, 4, 6, 8, 12, 16, 24, 48';
		jawabD = '1, 2, 4, 5, 6, 12, 24, 8';
		kunci = 'C';
	}
	else if (soal == 2)
	{
		pertanyaan = 'Kelipatan Persekutuan Terkecil (KPK) dari 72 dan 48 adalah___';
		jawabA = '240';
		jawabB = '144';
		jawabC = '120';
		jawabD = '96';
		kunci = 'B';
	}
	else if (soal == 3)
	{
		pertanyaan = 'Faktor Persekutuan Terbesar (FPB) dari 36, 18 dan 72 adalah___';
		jawabA = '18';
		jawabB = '16';
		jawabC = '12';
		jawabD = '9';
		kunci = 'A';
	}
	else if (soal == 4)
	{
		pertanyaan = 'Rusuk sebuah kubus adalah 12 cm, maka volumenya___cm3';
		jawabA = '1.728';
		jawabB = '1.278';
		jawabC = '1.140';
		jawabD = '144';
		kunci = 'A';
	}
	else if (soal == 5)
	{
		pertanyaan = 'Perbandingan uang Heti, Budi dan Fitri adalah 2 : 4 : 5. Jika uang Budi Rp 1.600,00, maka jumlah uang mereka adalah___';
		jawabA = 'Rp 2.000,00';
		jawabB = 'Rp 2.400,00';
		jawabC = 'Rp 3.600,00';
		jawabD = 'Rp 4.400,00';
		kunci = 'D';
	}
	else if (soal == 6)
	{
		pertanyaan = 'Bacalah kutipan cerpen berikut!Aku bersyukur kepada Tuhan karena dia telah berubah. Aku pun memaafkannya, meskipun sampai saat ini aku belum bertemu dia lagi. Aku berharap suatu hari nanti kami akan menjalin persahabatan lagi.Penggalan cerpen di atas merupakan bagian ___';
		jawabA = 'Krisis';
		jawabB = 'Resolusi';
		jawabC = 'Orientasi';
		jawabD = 'Komplikasi';
		kunci = 'B';
	}
	else if (soal == 7)
	{
		pertanyaan = 'Bacalah teks berikut!Penduduk desa binaan PKK provinsi mulai membajak sawah. Mereka akan menanam padi karena musim hujan sudah hadir.Penggunaan kata yang tidak tepat pada paragraf di atas adalah ';
		jawabA = 'Binaan';
		jawabB = 'Membajak';
		jawabC = 'Musim';
		jawabD = 'Hadir';
		kunci = 'D';
	}
	else if (soal == 8)
	{
		pertanyaan = 'Walaupun tiap hari berpeluh keringat, tak sedikit pun Fahri mengeluh. Semangatnya keras bagaikan baja.Kalimat kedua pada paragraf di atas mengandung majas ___';
		jawabA = 'Metafora';
		jawabB = 'Asosiasi';
		jawabC = 'Personifikasi';
		jawabD = 'Metonimia';
		kunci = 'B';
	}
	else if (soal == 9)
	{
		pertanyaan = 'ldpcghdrwjyjrrcpk<br>'+
						'cobalah pecahkan <br>'+
						'hint: 5x 5(odd) 5x 5(even)';
		jawabA = 'gampang';
		jawabB = 'abcdefghijkl';
		jawabC = 'ronaldo';
		jawabD = 'estebes';
		kunci = 'A';
	}
	else if (soal == 10)
	{
		pertanyaan = 'Batako berjumlah 8760 buah diperlukan untuk membangun 365 buah bak bunga. Batako yang diperlukan untuk setiap bak bunga adalah___buah ';
		jawabA = '18';
		jawabB = '24';
		jawabC = '32';
		jawabD = '36';
		kunci = 'B';
	}
	else if (soal == 11)
	{
		pertanyaan = 'Yang mana dibawah ini yang merupakan IP address yang valid?';
		jawabA = '255.256.123.10';
		jawabB = '109.312.212.10.901';
		jawabC = '-1.049.213.255';
		jawabD = '192.168.51.1';
		kunci = 'D';
	}
	else if (soal == 12)
	{
		pertanyaan = 'Di bawah yang bukan termasuk OS adalah ';
		jawabA = 'Windows';
		jawabB = 'AMD';
		jawabC = 'Linux';
		jawabD = 'Ubuntu';
		kunci = 'B';
	}
	else if (soal == 13)
	{
		pertanyaan = 'Dua buah lampu dinyalakan bersama-sama, lampu hijau menyala setiap 15 detik dan lampu merah menyala setiap 12 detik. Kedua lampu tersebut akan menyala secara bersama-sama pada detik ke___';
		jawabA = '60';
		jawabB = '30';
		jawabC = '24';
		jawabD = '18';
		kunci = 'A';
	}
	else if (soal == 14)
	{
		pertanyaan = 'Ikan yang dapat bertahan tanpa air di bawah ini adalah___';
		jawabA = 'Dolphin';
		jawabB = 'Dipnoi';
		jawabC = 'Nemo';
		jawabD = 'Ikan Hiu';
		kunci = 'B';
		
	}
	else if (soal == 15)
	{
		pertanyaan = 'Berapa lama jangka waktu agar cahaya dapat melakukan perjalanan dari Matahari ke Bumi? ';
		jawabA = '8 menit dan 19 detik';
		jawabB = '3 jam 2 menit 12,2 detik';
		jawabC = '16,17 detik';
		jawabD = '1 jam 32 menit 54 detik';
		kunci = 'A';
	}	
	else 
	{
		pertanyaan = 'Berapa lama jangka waktu agar cahaya dapat melakukan perjalanan dari Matahari ke Bumi? ';
		jawabA = '8 menit dan 19 detik';
		jawabB = '3 jam 2 menit 12,2 detik';
		jawabC = '16,17 detik';
		jawabD = '1 jam 32 menit 54 detik';
		kunci = 'A';
	}	
	kunciJWB[count+1] = kunci;
	
	/*
	let list = document.getElementById("soalPage");
	for(var x=1;x<=15;x++)
	{
		list.innerHTML += kunciJWB[x];
	}
	list.innerHTML += '<br>';
	*/
	
	$("#soal").html(
					'<br> <h3>'+(count+1)+'.'+  pertanyaan + '<h3><br>' 
							+ '<button id="buttonA" class="answerButton btn btn-custom1 btn-lg page-scroll"  onclick="dataJawaban(' + "'A'," + (count+1)+  ')">'+   jawabA+'</button><br><br>'
							+ '<button id="buttonB" class="answerButton btn btn-custom1 btn-lg page-scroll" onclick="dataJawaban(' + "'B'," + (count+1)+  ')">'+   jawabB+'</button><br><br>'
							+ '<button id="buttonC" class="answerButton btn btn-custom1 btn-lg page-scroll" onclick="dataJawaban(' + "'C'," + (count+1)+  ')">'+   jawabC+'</button><br><br>'
							+ '<button id="buttonD" class="answerButton btn btn-custom1 btn-lg page-scroll" onclick="dataJawaban(' + "'D'," + (count+1)+  ')">'+   jawabD+'</button><br><br>');
							
	if(jawaban[count+1] != "x")
		document.getElementById("button" + jawaban[count+1]).style = "background-color:green";
	idx = count;
}



function shuffle(array) {
  for (let i = array.length - 1; i > 0; i--) {
    let j = Math.floor(Math.random() * (i + 1)); 
    [array[i], array[j]] = [array[j], array[i]]; 
  }
}

function keteranganJawaban(count)
{
	let soal = ordered[count];
	
	if (soal == 1)
		return'Faktor dari 48 adalah [C] <br><br>'+
				'Faktor dari suatu bilangan adalah bilangan-bilangan yang dapat membagi habis (bersisa nol) bilangan tertentu.'+
				'Jadi faktor dari 48 adalah 1, 2, 3, 4, 6, 8, 12, 16, 24, 48';	
	else if (soal == 2)
		return'Kelipatan Persekutuan Terkecil (KPK) dari 72 dan 48 adalah [B]<br><br>'+
				'KPK merupakan kelipatan persekutuan yang nilainya terkecil dari dari beberapa bilangan.'+
				'Kelipatan dari 72 adalah 72, 144, …'+
				'Kelipatan dari 48 adalah 48, 96, 144, …'+
				'Jadi Kelipatan Persekutuan Terkecil dari 72 dan 48 adalah 144';	
	else if (soal == 3)
		return'Faktor Persekutuan Terbesar (FPB) dari 36, 18 dan 72 adalah [A]<br><br>'+
				'FPB adalah faktor sekutu terbesar dari dua bilangan atau lebih.'+
				'Faktor dari 36 adalah 1, 2, 3, 4, 6, 9, 12, 18, 36'+
				'Faktor dari 18 adalah 1, 2, 3, 6, 9, 18'+
				'Faktor dari 72 adalah 1, 2, 3, 4, 6, 8, 9, 12, 18, 24, 36, 72'+
				'Faktor persekutuan dari 36, 18 dan 72 adalah 1, 2, 3, 6, 9, 18'+
				'Jadi FPB dari 36, 18 dan 72 adalah 18.';	
	else if (soal == 4)
		return 'Rusuk sebuah kubus adalah 12 cm, maka volumenya [A] cm3<br><br>'+
				'Volume kubus = s3 (s = panjang rusuk)'+
				'= 123' +
				'= 12 x 12 x 12'+
				'= 144 x 12'+
				'= 1728 cm3';	
	else if (soal == 5)
		return 'Perbandingan uang Heti, Budi dan Fitri adalah 2 : 4 : 5. Jika uang Budi Rp 1.600,00, maka jumlah uang mereka adalah [B] <br><br>'+
				'Diketahui: uang Budi = Rp 1.600,00.' +
				'Perbandingan uang Heti, Budi, Fitri = 2 : 4 : 5.'+
				'Sehingga uang Heti = Rp 1.600,00 = Rp 800,00'+
				'Uang Fitri =  Rp 1.600,00 = Rp 2.000,00'+
				'Jumlah uang mereka = uang Budi + uang Heti + uang Fitri'+
				'=  Rp 1.600,00 + Rp 800,00 + Rp 2.000,00 = Rp 4.400,00';	
	else if (soal == 6)
		return 'Bacalah kutipan cerpen berikut!Aku bersyukur kepada Tuhan karena dia telah berubah. Aku pun memaafkannya, meskipun sampai saat ini aku belum bertemu dia lagi. Aku berharap suatu hari nanti kami akan menjalin persahabatan lagi.Penggalan cerpen di atas merupakan bagian [B] <br><br>'+	
				'Struktur teks cerpen yaitu: Orientasi: tahap perkenalan Komplikasi: tahap permasalahan yang terjadi'+
			'Resolusi: tahap penyelesaian masalah Jadi, penggalan cerpen di atas merupakan bagian resolusi.'
	else if (soal == 7)
		return 'Bacalah teks berikut!Penduduk desa binaan PKK provinsi mulai membajak sawah. Mereka akan menanam padi karena musim hujan sudah hadir.Penggunaan kata yang tidak tepat pada paragraf di atas adalah [D] <br><br>'+
				'Penggunaan kata hadir pada kalimat musim hujan sudah hadir tidak tepat, seharusnya musim hujan sudah tiba.'
	else if (soal == 8)
		return 'Walaupun tiap hari berpeluh keringat, tak sedikit pun Fahri mengeluh. Semangatnya keras bagaikan baja.Kalimat kedua pada paragraf di atas mengandung majas [B] <br><br>'+
				'Metafora : Gaya bahasa yang pemakaian kata-katanya bukan arti sebenernya.'+
				'Asosiasi : Gaya bahasa yang membandingkan dua hal yang berbeda tapi dianggap sama.'+
				'Personifikasi : Gaya bahasa yang menggunakan pengumpamaan benda mati sebagai orang atau manusia.'+
				'Metonimia : Gaya bahasa yang menggunakan nama barang bagi sesuatu yang lain yang berkaitan erat. Contoh : Negara Matahari Terbit memberikan beasiswa khusus untuk pelajar Indonesia.'+
				'Sinekdoke : Gaya bahasa yang menyebutkan nama bagian sebagai pengganti nama keseluruhannya. Majas ini dibagi menjadi 2 yaitu Pars Pro Toto (merupakan gaya bahasa yang mengungkapkan sebagian untuk menyatakan keseluruhan).';
	else if (soal == 9)
		return 'ldpcghdrwjyjrrcpk<br>'+
				'cobalah pecahkan <br>'+
				'hint: 5x 5(odd) 5x 5(even)'+
				'[A] <br><br>'+
				'ldpcg hdrwj yjrrc pk <br>'+
				'(ldpcg)tidak dipakai (hdrwj) ditambah secara berurut[1,3,5,7,9] (yjrrc)tidak dipakai (pk)ditambah secara berurut[2,4,6,8,10] <br>'+
				'xxxxx gampa xxxxx ng =  gampang';
	else if (soal == 10)
		return'Batako berjumlah 8760 buah diperlukan untuk membangun 365 buah bak bunga. Batako yang diperlukan untuk setiap bak bunga adalah [B] buah <br><br>'+
				'Banyaknya batako = 8760 : 365 = 24 buah';	
	else if (soal == 11)
		return'Yang mana dibawah ini yang merupakan IP address yang valid? [D] <br><br>'+
				'IP Address terdiri dari 4(0.0.0.0) angka yang ada diantara 0-255';	
	else if (soal == 12)
		return'Di bawah yang bukan termasuk OS adalah [B] <br><br>'+
				'AMD bukan sistem operasi';	
	else if (soal == 13)
		return'Dua buah lampu dinyalakan bersama-sama, lampu hijau menyala setiap 15 detik dan lampu merah menyala setiap 12 detik. Kedua lampu tersebut akan menyala secara bersama-sama pada detik ke [A] <br><br>'+
				'Soal ini sama dengan soal untuk mencari Kelipatan Persekutuan Terkecil (KPK).'+
				'Kelipatan 15 adalah 15, 30, 45, 60,__'+
				'Kelipatan 12 adalah 12, 24, 36, 48, 60,__'+
				'Kelipatan Persekutuan Terkecil dari 15 dan 12 adalah 60.'+
				'Sehingga kedua lampu menyala bersama-sama pada detik ke-60';	
	else if (soal == 14)
		return'Ikan yang dapat bertahan tanpa air di bawah ini adalah [B] <br><br>' +
				'Dipnoi adalah kelompok ikan sarcopterygiian, yang umumnya dikenal sebagai lungfish. "Paru-paru" mereka adalah kandung kemih yang dimodifikasi, yang pada sebagian besar ikan digunakan untuk daya apung dalam berenang, tetapi dalam lungfish juga menyerap oksigen dan menghilangkan limbah.';	
	else if (soal == 15)
		return'Berapa lama jangka waktu agar cahaya dapat melakukan perjalanan dari Matahari ke Bumi? [A] <br><br>'+
				'Di ruang angkasa, cahaya bergerak dengan kecepatan 300.000 kilometer (186.000 mil) per detik. Bahkan pada kecepatan sangat tinggi ini, meliputi 150 juta kilometer ganjil (93 juta mil) antara kita dan Matahari membutuhkan waktu yang cukup lama. Dan delapan menit masih sangat sedikit dibandingkan dengan lima setengah jam yang dibutuhkan cahaya Matahari untuk mencapai Pluto.';
}


var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope) {
    $scope.sh = "Stephen Hawking";
    $scope.nm = "Nelson Mandala";    
	$scope.lm = "Lionel Messi";    
	$scope.em = "eminem";    
});


function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}














