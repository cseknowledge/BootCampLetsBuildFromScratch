<?php 

echo "\e[1mbold\e[0m".PHP_EOL;
echo "\e[2mdim\e[22m".PHP_EOL;
echo "\e[3mitalic\e[23m".PHP_EOL;
echo "\e[4munderline\e[24m".PHP_EOL;
echo "\e[4:1mthis is also underline (new in 0.52)\e[4:0m".PHP_EOL;
echo "\e[21mdouble underline (new in 0.52)\e[24m".PHP_EOL;
echo "\e[4:2mthis is also double underline (new in 0.52)\e[4:0m".PHP_EOL;
echo "\e[4:3mcurly underline (new in 0.52)\e[4:0m".PHP_EOL;
echo "\e[5mblink (new in 0.52)\e[25m".PHP_EOL;
echo "\e[7mreverse\e[27m".PHP_EOL;
echo "\e[8minvisible\e[28m <- invisible (but copy-pasteable)".PHP_EOL;
echo "\e[9mstrikethrough\e[29m".PHP_EOL;
echo "\e[53moverline (new in 0.52)\e[55m".PHP_EOL;

echo "\e[31mred\e[39m".PHP_EOL;
echo "\e[91mbright red\e[39m".PHP_EOL;
echo "\e[38:5:42m256-color, de jure standard (ITU-T T.416)\e[39m".PHP_EOL;
echo "\e[38;5;42m256-color, de facto standard (commonly used)\e[39m".PHP_EOL;
echo "\e[38:2::240:143:104mtruecolor, de jure standard (ITU-T T.416) (new in 0.52)\e[39m".PHP_EOL;
echo "\e[38:2:240:143:104mtruecolor, rarely used incorrect format (might be removed at some point)\e[39m".PHP_EOL;
echo "\e[38;2;240;143;104mtruecolor, de facto standard (commonly used)\e[39m".PHP_EOL;

echo "\e[46mcyan background\e[49m".PHP_EOL;
echo "\e[106mbright cyan background\e[49m".PHP_EOL;
echo "\e[48:5:42m256-color background, de jure standard (ITU-T T.416)\e[49m".PHP_EOL;
echo "\e[48;5;42m256-color background, de facto standard (commonly used)\e[49m".PHP_EOL;
echo "\e[48:2::240:143:104mtruecolor background, de jure standard (ITU-T T.416) (new in 0.52)\e[49m".PHP_EOL;
echo "\e[48:2:240:143:104mtruecolor background, rarely used incorrect format (might be removed at some point)\e[49m".PHP_EOL;
echo "\e[48;2;240;143;104mtruecolor background, de facto standard (commonly used)\e[49m".PHP_EOL;

echo "\e[21m\e[58:5:42m256-color underline (new in 0.52)\e[59m\e[24m".PHP_EOL;
echo "\e[21m\e[58;5;42m256-color underline (new in 0.52)\e[59m\e[24m".PHP_EOL;
echo "\e[4:3m\e[58:2::240:143:104mtruecolor underline (new in 0.52) (*)\e[59m\e[4:0m".PHP_EOL;
echo "\e[4:3m\e[58:2:240:143:104mtruecolor underline (new in 0.52) (might be removed at some point) (*)\e[59m\e[4:0m".PHP_EOL;
echo "\e[4:3m\e[58;2;240;143;104mtruecolor underline (new in 0.52) (*)\e[59m\e[4:0m".PHP_EOL;