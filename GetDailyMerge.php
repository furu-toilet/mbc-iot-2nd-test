<?php
/*
GetDailyMerge.php�ɂ���
1�����Ƃ̃g�C���g�p�񐔂Ǝg�p���Ԃ�߂�l�Ƃ��ĕԂ�php
�O���t�ł̎d�l�Ȃ̂Ŗ߂�l�� echo �ɂĕԂ��B
���`����json
*/
require_once "Common.php";      //�`�`���܂��Ȃ��`�`
$db = new Common();             //
$result = array();
$timezone = 24;   //�O���t�̃������������܂ŕ\�����邩���߂�B
/*�O���t�p�f�[�^�̓y����쐬����    
ex�j[
    ['���ԑ�','�g�p��','�g�p����'],
    [0:00,  0   ,   1],
    [1:00,  0   ,   2],
         �E
         �E
         �E
    [23:00, 0   ,   15]
*/
//�����̎��ԑт��Ƃ̎g�p�񐔂Ǝg�p���Ԃ����߂�SQL���i�[����B
$sql = "
SELECT EXTRACT (HOUR FROM \"StartTime\")  ||':00',COUNT(*),sum(\"UsedTime\")
FROM \"RuiInfo\"
WHERE CAST(\"StartTime\" as DATE) = CAST(CURRENT_TimeStamp + '9 hours'  as DATE)
GROUP BY EXTRACT(HOUR FROM \"StartTime\")
ORDER BY EXTRACT(HOUR FROM \"StartTime\");
";      //DBManager����SQL�������܂����炱���ɓ��́I
$daydata = $db->db_sql($sql);    //�񎟌��z����擾�B�@�l�� ���ԑ�(Str�^),�g�p��(Int�^),�g�p����(Int�^)
array_push($result,array("���ԑ�","�g�p��","�g�p����"));
for($i=0;$i<$timezone;$i++)     //���ԑтƎg�p�񐔁A�g�p���� 0���Z�b�g����
{
    array_push($result,[$i.":00",0,0]);
}
$icount = 0;
foreach($result as $i)      //0:00�`23:00�܂ł̃f�[�^���i�[����B    i
{    
    foreach($daydata as $list)    //$daycount�̃f�[�^�̐�����foreach������    j
    {
        if(strcmp($list['?column?'],$icount.":00") == 0)    //$list�̎��ԑт��Q�Ƃ��A�Ή����镔���Ƀf�[�^���i�[����
        {                
            $result[$icount + 1][1] = $list['count'];
            $result[$icount + 1][2] = $list['sum'];
            break;        //�f�[�^���i�[�����ꍇ�A���[�v�𔲂���
        }            
    }
    $icount++;
} 
echo json_encode( $result);//json�Ŏg�p����^�ɕϊ�����B
?>