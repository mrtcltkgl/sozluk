<div class="container">
  <h2>Bu zamana kadar atılan mesajları aşağıda listelenmektedir...</h2>
  <p>Bulut sözlük mesajlar sayfasına hoşgeldiniz...</p>            
  <table class="table">
    <thead>
      <tr class="info">
        <th>Mesaj İçeriği</th>
        <th>Mesaj Başlığı</th>
        <th>Mesajı Oluşturan Kişi</th>
      </tr>
    </thead>
    <tbody>

<?php
use yii\db\Query;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
echo \yii\widgets\ListView::widget([
'dataProvider'=>$provider,
'itemView'=>function($model)
{
	$baslik_adi=$model->title_id;
	$kullanici_adi=$model->user_id;
	
	$query = new Query;
	$query	->select('name')
			->from('titles')
			->where (['id' =>$baslik_adi]);

	$command = $query->createCommand();
	$baslik = $command->queryOne();
	
	$query = new Query;
	$query	->select('username')
			->from('user')
			->where (['id' =>$kullanici_adi]);

	$command = $query->createCommand();
	$kullanici = $command->queryOne();	
	
	

	return '

      <tr>
        <td class="success">'.$model->message.'</td>
        <td class="danger">'.$baslik["name"].'</td>
        <td class="active">'.$kullanici["username"].'</td>
      </tr>

	';
}
]);
?>

    </tbody>
  </table>
</div>
