@CLS
@SET VERSION=4.0.1
@SET VERDATE=2011��1��12��
@SET VERCONF=csft_rtindex.conf
@SET VERINDEX=rtindex
@SET VERINFO=RTʵʱ����
@SET VERTEST=test_coreseek_rtindex.php
@IF NOT "%1" == "" @SET VERCONF=%1
@IF NOT "%2" == "" @SET VERINDEX=%2
@IF NOT "%3" == "" @SET VERINFO=%3
@IF NOT "%4" == "" @SET VERTEST=%4

@SET TITLE=coreseek-%VERSION% win32����ƽ̨��%VERDATE%���¡���%VERINFO%���ԡ�
@TITLE %TITLE%
@ECHO %TITLE%
@PROMPT coreseek-%VERSION% [ $D $T ] $_$$$G
@SET path=.;bin;%path%
@ECHO. && @ECHO ���ü�飺indexer -c etc\%VERCONF%
@indexer -c etc\%VERCONF%
@ECHO. && @ECHO ����ʹ���ĵ�����鿴��http://www.coreseek.cn/products/products-install/
@ECHO. && @ECHO ���Գ�����ʹ�� api/%VERTEST% ������������ && @ECHO ָ����ԣ��� CTRL+C��Ȼ��ѡ�� N�����������в��Ի���
@ECHO. && @ECHO ��������searchd  -c etc\%VERCONF% && @ECHO ����˵����������ʾ�����Ŀ��ܲ���ʾ������Ӱ��PHP����
@searchd  -c etc\%VERCONF% 
@%ComSpec% /Q /K ECHO.
