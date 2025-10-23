
/* This file was generated automatically by Zephir do not modify it! */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include <php.h>

#include "php_ext.h"
#include "zeplab.h"

#include <ext/standard/info.h>

#include <Zend/zend_operators.h>
#include <Zend/zend_exceptions.h>
#include <Zend/zend_interfaces.h>

#include "kernel/globals.h"
#include "kernel/main.h"
#include "kernel/fcall.h"
#include "kernel/memory.h"



zend_class_entry *zeplab_foo_ce;

ZEND_DECLARE_MODULE_GLOBALS(zeplab)

PHP_INI_BEGIN()
	
PHP_INI_END()

static PHP_MINIT_FUNCTION(zeplab)
{
	REGISTER_INI_ENTRIES();
	zephir_module_init();
	ZEPHIR_INIT(ZepLab_Foo);
	
	return SUCCESS;
}

#ifndef ZEPHIR_RELEASE
static PHP_MSHUTDOWN_FUNCTION(zeplab)
{
	
	zephir_deinitialize_memory();
	UNREGISTER_INI_ENTRIES();
	return SUCCESS;
}
#endif

/**
 * Initialize globals on each request or each thread started
 */
static void php_zephir_init_globals(zend_zeplab_globals *zeplab_globals)
{
	zeplab_globals->initialized = 0;

	/* Cache Enabled */
	zeplab_globals->cache_enabled = 1;

	/* Recursive Lock */
	zeplab_globals->recursive_lock = 0;

	/* Static cache */
	memset(zeplab_globals->scache, '\0', sizeof(zephir_fcall_cache_entry*) * ZEPHIR_MAX_CACHE_SLOTS);

	
	
}

/**
 * Initialize globals only on each thread started
 */
static void php_zephir_init_module_globals(zend_zeplab_globals *zeplab_globals)
{
	
}

static PHP_RINIT_FUNCTION(zeplab)
{
	zend_zeplab_globals *zeplab_globals_ptr;
	zeplab_globals_ptr = ZEPHIR_VGLOBAL;

	php_zephir_init_globals(zeplab_globals_ptr);
	zephir_initialize_memory(zeplab_globals_ptr);

	
	return SUCCESS;
}

static PHP_RSHUTDOWN_FUNCTION(zeplab)
{
	
	zephir_deinitialize_memory();
	return SUCCESS;
}



static PHP_MINFO_FUNCTION(zeplab)
{
	php_info_print_box_start(0);
	php_printf("%s", PHP_ZEPLAB_DESCRIPTION);
	php_info_print_box_end();

	php_info_print_table_start();
	php_info_print_table_header(2, PHP_ZEPLAB_NAME, "enabled");
	php_info_print_table_row(2, "Author", PHP_ZEPLAB_AUTHOR);
	php_info_print_table_row(2, "Version", PHP_ZEPLAB_VERSION);
	php_info_print_table_row(2, "Build Date", __DATE__ " " __TIME__ );
	php_info_print_table_row(2, "Powered by Zephir", "Version " PHP_ZEPLAB_ZEPVERSION);
	php_info_print_table_end();
		php_info_print_table_start();
	php_info_print_table_row(2, "homepage", "https://schrodt.nrw");
	php_info_print_table_end();

	DISPLAY_INI_ENTRIES();
}

static PHP_GINIT_FUNCTION(zeplab)
{
#if defined(COMPILE_DL_ZEPLAB) && defined(ZTS)
	ZEND_TSRMLS_CACHE_UPDATE();
#endif

	php_zephir_init_globals(zeplab_globals);
	php_zephir_init_module_globals(zeplab_globals);
}

static PHP_GSHUTDOWN_FUNCTION(zeplab)
{
	
}


zend_function_entry php_zeplab_functions[] = {
	ZEND_FE_END

};

static const zend_module_dep php_zeplab_deps[] = {
	
	ZEND_MOD_END
};

zend_module_entry zeplab_module_entry = {
	STANDARD_MODULE_HEADER_EX,
	NULL,
	php_zeplab_deps,
	PHP_ZEPLAB_EXTNAME,
	php_zeplab_functions,
	PHP_MINIT(zeplab),
#ifndef ZEPHIR_RELEASE
	PHP_MSHUTDOWN(zeplab),
#else
	NULL,
#endif
	PHP_RINIT(zeplab),
	PHP_RSHUTDOWN(zeplab),
	PHP_MINFO(zeplab),
	PHP_ZEPLAB_VERSION,
	ZEND_MODULE_GLOBALS(zeplab),
	PHP_GINIT(zeplab),
	PHP_GSHUTDOWN(zeplab),
#ifdef ZEPHIR_POST_REQUEST
	PHP_PRSHUTDOWN(zeplab),
#else
	NULL,
#endif
	STANDARD_MODULE_PROPERTIES_EX
};

/* implement standard "stub" routine to introduce ourselves to Zend */
#ifdef COMPILE_DL_ZEPLAB
# ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
# endif
ZEND_GET_MODULE(zeplab)
#endif
