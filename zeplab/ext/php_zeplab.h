
/* This file was generated automatically by Zephir do not modify it! */

#ifndef PHP_ZEPLAB_H
#define PHP_ZEPLAB_H 1

#ifdef PHP_WIN32
#define ZEPHIR_RELEASE 1
#endif

#include "kernel/globals.h"

#define PHP_ZEPLAB_NAME        "zeplab"
#define PHP_ZEPLAB_VERSION     "0.0.1"
#define PHP_ZEPLAB_EXTNAME     "zeplab"
#define PHP_ZEPLAB_AUTHOR      "Sven Schrodt"
#define PHP_ZEPLAB_ZEPVERSION  "0.19.0-$Id$"
#define PHP_ZEPLAB_DESCRIPTION "Personal Zephir Playground"



ZEND_BEGIN_MODULE_GLOBALS(zeplab)

	int initialized;

	/** Function cache */
	HashTable *fcache;

	zephir_fcall_cache_entry *scache[ZEPHIR_MAX_CACHE_SLOTS];

	/* Cache enabled */
	unsigned int cache_enabled;

	/* Max recursion control */
	unsigned int recursive_lock;

	
ZEND_END_MODULE_GLOBALS(zeplab)

#ifdef ZTS
#include "TSRM.h"
#endif

ZEND_EXTERN_MODULE_GLOBALS(zeplab)

#ifdef ZTS
	#define ZEPHIR_GLOBAL(v) ZEND_MODULE_GLOBALS_ACCESSOR(zeplab, v)
#else
	#define ZEPHIR_GLOBAL(v) (zeplab_globals.v)
#endif

#ifdef ZTS
	ZEND_TSRMLS_CACHE_EXTERN()
	#define ZEPHIR_VGLOBAL ((zend_zeplab_globals *) (*((void ***) tsrm_get_ls_cache()))[TSRM_UNSHUFFLE_RSRC_ID(zeplab_globals_id)])
#else
	#define ZEPHIR_VGLOBAL &(zeplab_globals)
#endif

#define ZEPHIR_API ZEND_API

#define zephir_globals_def zeplab_globals
#define zend_zephir_globals_def zend_zeplab_globals

extern zend_module_entry zeplab_module_entry;
#define phpext_zeplab_ptr &zeplab_module_entry

#endif
