
extern zend_class_entry *zeplab_foo_ce;

ZEPHIR_INIT_CLASS(ZepLab_Foo);

PHP_METHOD(ZepLab_Foo, foo);

ZEND_BEGIN_ARG_WITH_RETURN_TYPE_INFO_EX(arginfo_zeplab_foo_foo, 0, 0, IS_VOID, 0)
ZEND_END_ARG_INFO()

ZEPHIR_INIT_FUNCS(zeplab_foo_method_entry) {
	PHP_ME(ZepLab_Foo, foo, arginfo_zeplab_foo_foo, ZEND_ACC_PUBLIC)
	PHP_FE_END
};
