<?php

//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//$a1 = new A();
//$a2 = new A();
//$a1->foo(); // 1 ++сначала прибавляет потом выводит, из-за статической переменной а1 и а2, получились в роли
//$a2->foo(); // 2 ссылки, соответсвенно меняется каждую выполенную функцию, ч увеличивется на 1
//$a1->foo(); // 3
//$a2->foo(); // 4


class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();