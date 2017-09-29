<?php
namespace Sjzxf\Controller;
use Think\Controller;
use Think\Model;


header("Content-Type:text/html; charset=utf-8");

class IndexController extends Controller {
    public function index(){
        layout(false);
        $date_str=date("Y-m-d");
        $this->assign('date_str',$date_str);
        $this->assign('week_str',wk($date_str));
        $newsModel = M('news');
        $news = $newsModel
            ->join('news_c ON news_c.tid = news.id')
            ->order('news.id desc')
            ->find();
        $news_date = date('Y-m-d',$news['updatetime']);
        $news['updatetime'] = $news_date;
        $this->assign('news',$news);
        $this->display();
    }
    public function search(){
        import('Vendor.Sphinx');
        $q_kwd = I('get.keyw','','htmlspecialchars');
        //import('ORG.Util.Page');
        import('Vendor.Page');
        $PageSize=5;//分页大小
        $nowPage=I('get.p',1);//当前页
        $nowPage = $nowPage>1 ? $nowPage : 1;
        
        /**
         *关键词高亮显示，以及产生文本摘要
         *BuildExcerpts($docs, $index, $words, $opts=array())
         *参数(包含文档内容的数组,索引名,关键词,高亮参数)
         **/
        $opts = array(
            "before_match"    => "<font color='red'>",    //关键词高亮开始的html代码
            "after_match"    => "</font>",                //关键词高亮结束的html代码
            // "limit"            => 100,                        //摘要最多包含的符号数，默认256
            // "around"        => 3,                        //每个关键词左右选取的词的数目，默认为5
        );
        $sph = new \SphinxClient();//实例化 sphinx 对象
        $sph->SetServer('127.0.0.1','9312');//连接9312端口
        $sph->SetConnectTimeout(3);//设置超时时间

        //$sph->SetSortMode(SPH_SORT_RELEVANCE);    //查询结果根据相似度排序
        $sph->SetSortMode(SPH_SORT_EXTENDED, "@weight desc,updatetime ASC");//先按权重 再按时间排序
        //$sph->SetSortMode ( SPH_SORT_ATTR_DESC, "updatetime" ); //按照updatetime降序排序
        $sph->SetArrayResult(false);//设置结果返回格式,true以数组,false以PHP hash格式返回，默认为false
        //$sph->setFilter('status',array(1));

        if(strlen($q_kwd)>=18){
            $sph->SetMatchMode(SPH_MATCH_ALL);//如果用户查询字符大于=18个匹配有查询词
        }else{
            $sph->SetMatchMode(SPH_MATCH_ANY);//设置匹配方式,匹配查询词中的任意一个
        }

        $off=($nowPage-1)*$PageSize;
        $sph->SetLimits($off,$PageSize);//传递当前页面所需的数据条数的参数
        $result = $sph->Query($q_kwd,'*');//执行搜索操作,参数(关键词，[索引名])


        if(!array_key_exists('matches', $result)){//如果没有匹配结果，直接返回
            $ids='';
            $pagedata=array();

        }else{
            $arr_key = array_keys($result['matches']);//取出matches中的ID//获取到匹配文章的ID
            $ids = implode(',',$arr_key);//数组转成字符串

            $table_main='news';
            $table_sub='news_c';
            $sql="SELECT a.id,title,FROM_UNIXTIME(updatetime) as updatetime,content FROM ".$table_main." a left join ".$table_sub." b on a.id=b.id where a.id in({$ids})";
            $pagedata=M()->query($sql);

        }


        $pagedata2=array();
        foreach($pagedata as $v){
            $pagedata2[] = $sph->BuildExcerpts($v, 'mysql', $q_kwd, $opts);//使用高亮显示代码,使用高亮速度慢
            //$pagedata2[]=$v;

        }

        $this->pagedata =$pagedata2;

        $count=$result['total'];//sphinx搜索总数
        //$count=count($pagedata);//sphinx搜索总数
        $Page = new \Think\Page($count,$PageSize);
       // $show=$Page->show();
        $Page->rollPage = 10;
        $Page->lastSuffix = false;//最后一页不显示为总页数
        $Page->setConfig('header','<li class="disabled hwh-page-info"><a>共<em>%TOTAL_ROW%</em>条  <em>%NOW_PAGE%</em>/%TOTAL_PAGE%页</a></li>');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','末页');
        $Page->setConfig('first','首页');
        $Page->setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = bootstrap_page_style($Page->show());

        //echo $this->pagedata;
        $this->q_wd=$q_kwd;
        $this->q_count=$count;
        $this->totalcount=$count;//记录总数
        
        $this->assign('pagecontent',$this->pagedata);
        $this->assign('page',$show);
        $this->display();

    }
    //新闻动态
    public function newscontent(){
        $this->display();
    }
  
    
}