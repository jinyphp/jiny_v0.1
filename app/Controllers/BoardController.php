<?php
namespace App\Controllers;

use \Jiny\Core\Controllers\Controller;
use \Jiny\Core\Registry\Registry;

class BoardController extends Controller
{
    private $db;

    private $table;
    private $board;
    private $action;

    public function __construct($app=NULL)
    {
        $this->setApp($app);

        // DB를 초기화 합니다.
        $this->db = \Jiny\Database\db_init(__DIR__."\..\..\conf\\"."dbconf.php");

        // 계시판 객체
        $this->table = "board5";
        $this->board = new \Jiny\Board\Data($this->db);
        $this->board->setBoard($this->table)->setField(['id','regdate','title']);

        $this->action = new \Jiny\Board\Action($this->board);
        $this->action->setView()->setBaseURI("/board");

    }

    // 기본실행 메서드
    public function index()
    {
        if (\Jiny\Board\_method() == "GET") {
            return $this->action->links("title", "/board/")->list();
        } else {
            $this->board->setLimit();                           // 출력위치 지정
            $count = $this->board->count();                     // 전체 글수
            $rows = $this->board->load()->setLinks()->get();    // 데이터처리
            return $rows;
        }
    }

    /**
     * 새로운 계시물을 삽입합니다.
     */
    public function new()
    {
        return $this->action->matching()->new();
    }

    public function __invoke()
    {
        $id = \Jiny\Board\id();
        if ($id) {
            // 삭제
            $this->action->delete($id);

            // 읽기
            return $this->action->view($id);
        }
        return "글보기 오류";   
    }

    public function edit()
    {
        $id = \Jiny\Board\id();
        return $this->action->edit($id);
    }


    public function admin()
    {
        $admin = new \Jiny\Board\Admin($this->db);

        $id = \Jiny\Board\id();
        if($id) {
            return $admin->edit($id);
        } else {
            return $admin->list();
        }
    }

    /**
     * 
     */
}