Yii 2.0 ile geliştirilmiş sözlük uygulamasının yazı modülü
----------------------------------------------------------

Uygulama'yı çalıştırabilmek için ilk olarak bilgisayarınızda [Yii Advanced Sürümü](https://github.com/yiisoft/yii2-app-advanced/blob/master/docs/guide/README.md) ve [Composer](https://getcomposer.org/download/) yüklü olması gerekmektedir. Yii kütüphanesi PHP üzerinde çalışan bir kütüphane olması nedeniyle bilgisayarınızda herhangi bir sanal sunucu uygulamasından yararlanabilirsiniz. Bu uygulama geliştirilirken [XAMPP](https://www.apachefriends.org/tr/download.html) uygulamasından yardım alındı.

Tüm bunlardan sonra uygulamayı çalıştırabilmek için ilk olarak proje dosyası içinde belirtilen sql yapısında veri veritabanına sahip olmanız gerekmektedir.

VT İçeriği
----------
<b>VT Adı:</b> advanced</br>
<b>Tablolar:</b></br>
	Kurulumla gelenler: user - migration</br>
	Yetkilendirmede kullanılanlar: auth_assignment - auth_item - auth_item_child - auth_rule</br>
	Gerekli olanlar: messages - tags - titles</br>
	
Kopyalanması Gerekenler
-----------------------
Veritabanı işlemleri tamamlandıktan sonra proje içerisindeki dökümanlardan olan yetki tabanlı işlemlerin gerçekleştirildiği 2 temel dosyamızı yii2.0 dosyamızın içerisinde ilgili alanlara kopyalamamız gerekmektedir.<br>
İlk olarak yii2.0 projenin kurulu olduğu dizini açalım.<br>
Daha sonra:<br>
1- Proje içinde bulunan <b>common/rbac</b> adlı dosyayı yii2.0'ın yüklü olduğu dizin içerisinde <b>common</b> alt dizini içerisinde <b>rbac</b> isimli klasör oluşturup bu dosyayı buraya atalım.<br>
2- Tekrar projenin kurulu olduğu dizine gelerek proje içerisinde <b>console/controllers</b> dizininde bulunan script dosyasını alarak Yii2.0'ın kurulu olduğu dizindeki <b>console>controllers</b> içerisine kopyalayalım.
	
Kuruluma Hazırlık
-----------------
<b>1-</b> Gerekli kopyalama işlemlerini tamamladıktan sonra ayar kısımlarını gerçekleştirmemiz gerekiyor. İlk olarak Yii'nin kurulu olduğu dizine gelerek composer.json dosyasını herhangi bir metin düzenleyici program yardımıyla açalım ve aşağıda belirtiği gibi güncelleyelim. <br>
..<b>Composer.json</b>..<br>
...<br>
"source": "https://github.com/yiisoft/yii2"<br>
    },<br>
    "minimum-stability": "stable",<br>
    "require": {<br>
        "php": ">=5.4.0",<br>
        "yiisoft/yii2": ">=2.0.6",<br>
        "yiisoft/yii2-bootstrap": "*",<br>
        "yiisoft/yii2-swiftmailer": "*",<br>
		<b>"mrtcltkgl/sozluk": "dev-master" // Eklenen satır.</b><br>
    },<br>
    "require-dev": {<br>
        "yiisoft/yii2-codeception": "*",<br>
...<br>
...<br><br>

<b>2-</b> Yukarıdaki işlemi tamamladıktan sonra Yii uygulamamızın dosya sistemimize uygun olması için Yii dizini içerisinde bulunan <b>Backend>Config>Main-local.php</b> dosyasını herhangi bir metin editörü ile açınız. $Config değişkenine aşağıda belirtilen kod parçacığını ekleyiniz.<br>

..<b>Main-local.php</b>..<br>
...<br>
	'modules'=>[<br>
		'sozluk'=>[<br>
			'class' =>'mrtcltkgl\sozluk\Sozluk',<br>
		],	<br>
	],<br>
...<br>
...<br>

<b>3- </b> Tüm bu işlemler sonucunda uygulama kuruluma hazır hale gelecektir. Burdan sonra tek yapmanız gereken aşağıdaki kodlar yardımıyla kurulumu gerçekleştirmek ve sonuç kısmında belirtilen açıklamaları okumak.<br>

Kurulum için Yii2.0'ın kurulu olduğu dizine komut satırında ulaşalım. Eğer daha önce kurulum yaptıksak önce <b>composer clear-cache</b> ile ön belleği temizleyelim. Eğer kurulum yapmadıysa veya ön bellek temizleme işlemini tamamladıysak <b>composer update</b> yardımıyla uygulama kurulumuna başlayabilirsiniz. Bu işlem 4-5 dakika sürmektedir.<br>

Sonuç
-----

<br>Artık projeyi kendi bilgisayarınıza kurdunuz. Proje içerisinde 3 tip kullanıcı hesabı bulunmaktadır. Bunları oluşturmanız temel olarak programın işleyişini anlamanızda yardımcı olacaktır.<br>
<b>Bu kullanıcı tipleri:</b> 1-Admin 2-Moderator 3-Yazar (numaraları aynı zamanda id'lere karşılık gelmektedir)<br>

<b>Admin:</b> Tüm yetkinin sahibidir.<br>
<b>Moderator:</b> Admin'den eksik olarak etiket yönetimi ile ilgili işlemleri gerçekleştiremez.<br>
<b>Yazar:</b> Başlık ve mesaj oluşturur ve sadece kendi oluşturdularını silip güncelleyebilir.<br>

<b>* </b>Giriş yapmayan kişi veritabanı ile ilgili işlemlerin hiçbirini gerçekleştiremez.<br>
<b>* </b>Uygulamanın işleyişi şu şekildedir. Yönetici sözlük'te konuşulacak etiketleri belirler. Bu etiketler ile ilgili başlıklar açılır. Başlıklara mesajlar bırakılır. Bu sayede sözlük içi basit bir mesaj sistemi kurulmuş olur.




