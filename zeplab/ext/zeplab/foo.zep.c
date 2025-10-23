
#ifdef HAVE_CONFIG_H
#include "../ext_config.h"
#endif

#include <php.h>
#include "../php_ext.h"
#include "../ext.h"

#include <Zend/zend_operators.h>
#include <Zend/zend_exceptions.h>
#include <Zend/zend_interfaces.h>

#include "kernel/main.h"
#include "kernel/object.h"
#include "kernel/fcall.h"
#include "kernel/operators.h"
#include "kernel/memory.h"


ZEPHIR_INIT_CLASS(ZepLab_Foo)
{
	ZEPHIR_REGISTER_CLASS(ZepLab, Foo, zeplab, foo, zeplab_foo_method_entry, 0);

	return SUCCESS;
}

PHP_METHOD(ZepLab_Foo, foo)
{

	php_printf("%s", "Foo");
}

PHP_METHOD(ZepLab_Foo, mirror)
{
	zephir_method_globals *ZEPHIR_METHOD_GLOBALS_PTR = NULL;
	zend_long ZEPHIR_LAST_CALL_STATUS;
	zval *txt_param = NULL;
	zval txt;

	ZVAL_UNDEF(&txt);
	ZEND_PARSE_PARAMETERS_START(1, 1)
		Z_PARAM_STR(txt)
	ZEND_PARSE_PARAMETERS_END();
	ZEPHIR_METHOD_GLOBALS_PTR = pecalloc(1, sizeof(zephir_method_globals), 0);
	zephir_memory_grow_stack(ZEPHIR_METHOD_GLOBALS_PTR, __func__);
	zephir_fetch_params(1, 1, 0, &txt_param);
	zephir_get_strval(&txt, txt_param);
	ZEPHIR_RETURN_CALL_FUNCTION("strrev", NULL, 1, &txt);
	zephir_check_call_status();
	RETURN_MM();
}

