
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


ZEPHIR_INIT_CLASS(ZepLab_Foo)
{
	ZEPHIR_REGISTER_CLASS(ZepLab, Foo, zeplab, foo, zeplab_foo_method_entry, 0);

	return SUCCESS;
}

PHP_METHOD(ZepLab_Foo, foo)
{

	php_printf("%s", "Foo");
}

