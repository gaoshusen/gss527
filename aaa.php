<?php
function jz($num)
{
    if($num < 0)
        die('must greater than 2 !');
    /***************** 拼出二维数组，初始值都是0 ***************************/
    for($i=0; $i<$num; $i++)
        for ($j=0; $j<$num; $j++)
            $arr[$i][$j] = 0;
    /*************** 初始化几个变量 ******************************************/
    $direction = 'r';   // 开始移动的方向 r[右] l[左] t[上] b[下]
    $maxNum = $num * $num + $num - 1; // 计算出最后一个数字
    $x = $y = 0;    // 放的格的坐标
    /******************************* 循环每个数字放到数组中相应位置上 ************/
    for ($i=$num; $i<=$maxNum; $i++)
    {
        if($arr[$x][$y] == 0)
            $arr[$x][$y] = $i;
        else 
        {
            if($direction == 'r')
            {
                if(($y+1) < $num && $arr[$x][$y+1] == 0)
                    $y++;
                else 
                    $direction = 'b';
            }
            if($direction == 'b')
            {
                if(($x+1) < $num && $arr[$x+1][$y] == 0)
                    $x++;
                else 
                    $direction = 'l';
            }
            if($direction == 'l')
            {
                if(($y-1) >= 0 && $arr[$x][$y-1] == 0)
                    $y--;
                else 
                    $direction = 't';
            }
            if($direction == 't')
            {
                if(($x-1) >= 0 && $arr[$x-1][$y] == 0)
                    $x--;
                else 
                {
                    $direction = 'r';
                    if($direction == 'r')
                    {
                        if(($y+1) < $num && $arr[$x][$y+1] == 0)
                            $y++;
                        else 
                            $direction = 'b';
                    }
                }
            }
            $arr[$x][$y] = $i;
        }
    }
    /**************** 使用数组输出图形 ***************/
    $table = '<table border="1">';
    foreach ($arr as $v)
    {
        $table .= '<tr>';
            foreach ($v as $v1)
            {
                $table .= '<td>'.$v1.'</td>';
            }
        $table .= '</tr>';
    }
    $table .= '</table>';
    echo $table;
}


jz(3);