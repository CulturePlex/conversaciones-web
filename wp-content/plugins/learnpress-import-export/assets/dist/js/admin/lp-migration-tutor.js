/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/admin/tutor/migration.js":
/*!************************************************!*\
  !*** ./assets/src/js/admin/tutor/migration.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/url */ "@wordpress/url");
/* harmony import */ var _wordpress_url__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_url__WEBPACK_IMPORTED_MODULE_0__);

let tutorNode = document.querySelector('.lp-migration-wrapper .content.tutor');
let statusNode;
//course
let courseNode, migratedCourseTotal, coursePbNode;
//Section
let sectionNode, migratedSectionTotal, sectionPbNode;
//Course item
let courseItemNode, migratedCourseItemTotal, courseItemPbNode;
//Question
let questionNode, migratedQuestionTotal, questionPbNode;
//course process
let coursePcNode, migratedProcessCourseTotal, coursePcPbNode;
let autoMigrateBtn, clearDataBtn;
let courseIcon, sectionIcon, courseItemIcon, questionIcon, learnProgressIcon;
const migrateItemCheckBox = document.querySelectorAll('.migrate-item .migrate-item-checkbox');
// let paged = 1;

const restNamespace = LP_ADDON_IMPORT_EXPORT_GLOBAL_OBJECT?.rest_namespace || '';
const courseTotal = parseInt(LP_ADDON_IMPORT_EXPORT_GLOBAL_OBJECT?.tutor_course_total) || 0;
const sectionTotal = parseInt(LP_ADDON_IMPORT_EXPORT_GLOBAL_OBJECT?.tutor_section_total) || 0;
const courseItemTotal = parseInt(LP_ADDON_IMPORT_EXPORT_GLOBAL_OBJECT?.tutor_course_item_total) || 0;
const questionTotal = parseInt(LP_ADDON_IMPORT_EXPORT_GLOBAL_OBJECT?.tutor_question_total) || 0;
const courseProcessTotal = parseInt(LP_ADDON_IMPORT_EXPORT_GLOBAL_OBJECT?.tutor_course_process_total) || 0;
const beforeMigratePopup = document.querySelector('#lp-before-migrate-popup');
const clearDataPopup = document.querySelector('#lp-clear-migrated-data-popup');
const migrateSuccessPopup = document.querySelector('#lp-migrate-success-popup');
const bodyNode = document.querySelector('body');
const migratedReport = document.querySelector('#migration-report');
const migrateTutor = () => {
  if (!tutorNode) {
    return;
  }
  autoMigrateBtn = tutorNode.querySelector('#lp-auto-migrate-btn.tutor');
  clearDataBtn = tutorNode.querySelector('#lp-clear-migrate-btn');
  statusNode = tutorNode.querySelector('.status');

  //Course data
  courseNode = tutorNode.querySelector('.course');
  coursePbNode = courseNode.querySelector('.progress-bar');
  migratedCourseTotal = courseNode.querySelector('.migrated-course-total');
  courseIcon = courseNode.querySelector('.migrate-item-checkbox');

  //Section data
  sectionNode = tutorNode.querySelector('.section');
  sectionPbNode = sectionNode.querySelector('.progress-bar');
  migratedSectionTotal = sectionNode.querySelector('.migrated-section-total');
  sectionIcon = sectionNode.querySelector('.migrate-item-checkbox');

  //Course item data
  courseItemNode = tutorNode.querySelector('.course-item');
  courseItemPbNode = courseItemNode.querySelector('.progress-bar');
  migratedCourseItemTotal = courseItemNode.querySelector('.migrated-course-item-total');
  courseItemIcon = courseItemNode.querySelector('.migrate-item-checkbox');

  //Question data
  questionNode = tutorNode.querySelector('.question');
  questionPbNode = questionNode.querySelector('.progress-bar');
  migratedQuestionTotal = questionNode.querySelector('.migrated-question-total');
  questionIcon = questionNode.querySelector('.migrate-item-checkbox');

  //Course process data
  coursePcNode = tutorNode.querySelector('.course-process');
  coursePcPbNode = coursePcNode.querySelector('.progress-bar');
  migratedProcessCourseTotal = coursePcNode.querySelector('.migrated-process-course-total');
  learnProgressIcon = coursePcNode.querySelector('.migrate-item-checkbox');
  autoMigration();
  handleAfterMigrate();
  clearData();
  migrateReport();
};
const migrateReport = () => {
  const reportNode = document.querySelector('#migration-report');
  if (!reportNode) {
    return;
  }
  const courseItemNodes = reportNode.querySelectorAll('.course-item');
  [...courseItemNodes].map(courseItemNode => {
    const header = courseItemNode.querySelector('header');
    if (header) {
      header.addEventListener('click', function (event) {
        if (event.target.tagName === 'A') {
          return;
        }
        const headerIcon = header.querySelector('.header-icon');
        if (courseItemNode.classList.contains('active')) {
          headerIcon.innerHTML = plusIcon;
        } else {
          headerIcon.innerHTML = minusIcon;
        }
        courseItemNode.classList.toggle('active');
      });
    }
  });
};
const clearData = () => {
  if (!clearDataBtn || !clearDataPopup) {
    return;
  }
  clearDataBtn.addEventListener('click', function () {
    clearDataPopup.classList.add('active');
    bodyNode.classList.add('lp-no-scroll');
  });
  const cancelBtn = clearDataPopup.querySelector('button.cancel');
  const removePopupBtn = clearDataPopup.querySelector('a.remove-popup');
  const bgOverlay = clearDataPopup.querySelector('.bg-overlay');
  const clearMigratedBtn = clearDataPopup.querySelector('button.clear-migrated');
  cancelBtn.addEventListener('click', function () {
    clearDataPopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
  });
  removePopupBtn.addEventListener('click', function () {
    clearDataPopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
  });
  bgOverlay.addEventListener('click', function () {
    clearDataPopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
  });
  clearMigratedBtn.addEventListener('click', function (event) {
    event.preventDefault();
    clearDataPopup.classList.remove('active');
    clearDataBtn.disabled = true;
    [...migrateItemCheckBox].map(el => {
      el.innerHTML = `<div class="loader">`;
    });
    wp.apiFetch({
      path: '/' + restNamespace + '/delete-migrated-data/tutor',
      method: 'DELETE'
    }).then(res => {
      if (res.status && res.status === 'success') {
        statusNode.innerHTML = res.msg;
        statusNode.classList.remove('lp-migration-error');
        statusNode.classList.add('lp-migration-success');
        if (res?.data?.tutor_course_total) {
          autoMigrateBtn.disabled = false;
        }
        if (migratedReport) {
          migratedReport.remove();
        }
        reset();
      } else {
        statusNode.innerHTML = res.msg;
        statusNode.classList.add('lp-migration-error');
      }
    }).catch(err => {
      console.log(err);
    }).finally(() => {});
  });
};
const autoMigration = () => {
  if (!autoMigrateBtn || !beforeMigratePopup) {
    return;
  }
  autoMigrateBtn.addEventListener('click', function () {
    beforeMigratePopup.classList.add('active');
    bodyNode.classList.add('lp-no-scroll');
  });
  const cancelBtn = beforeMigratePopup.querySelector('button.cancel');
  const removePopupBtn = beforeMigratePopup.querySelector('a.remove-popup');
  const bgOverlay = beforeMigratePopup.querySelector('.bg-overlay');
  const migrateBtn = beforeMigratePopup.querySelector('button.migrate-now');
  cancelBtn.addEventListener('click', function () {
    beforeMigratePopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
  });
  removePopupBtn.addEventListener('click', function () {
    beforeMigratePopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
  });
  bgOverlay.addEventListener('click', function () {
    beforeMigratePopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
  });
  migrateBtn.addEventListener('click', function () {
    beforeMigratePopup.classList.remove('active');
    autoMigrateBtn.disabled = true;

    // statusNode.innerHTML = `<div class="loader">`;

    reset();
    removeStatus();
    bodyNode.classList.remove('lp-no-scroll');
    migrate();
  });
};
const reset = () => {
  coursePbNode.style.width = '0%';
  migratedCourseTotal.innerHTML = '0';
  sectionPbNode.style.width = '0%';
  migratedSectionTotal.innerHTML = '0';
  courseItemPbNode.style.width = '0%';
  migratedCourseItemTotal.innerHTML = '0';
  questionPbNode.style.width = '0%';
  migratedQuestionTotal.innerHTML = '0';
  coursePcPbNode.style.width = '0%';
  migratedProcessCourseTotal.innerHTML = 0;
  [...migrateItemCheckBox].map(el => {
    el.innerHTML = checkIcon;
  });
};
const removeStatus = () => {
  statusNode.innerHTML = '';
  statusNode.classList.remove('lp-migration-success');
  statusNode.classList.remove('lp-migration-error');
};
const checkedIcon = `
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M8 1.33333C4.3181 1.33333 1.33333 4.3181 1.33333 8C1.33333 11.6819 4.3181 14.6667 8 14.6667C11.6819 14.6667 14.6667 11.6819 14.6667 8C14.6667 4.3181 11.6819 1.33333 8 1.33333ZM0 8C0 3.58172 3.58172 0 8 0C12.4183 0 16 3.58172 16 8C16 12.4183 12.4183 16 8 16C3.58172 16 0 12.4183 0 8Z" fill="#34C759"/>
		<path d="M11.0685 5.4759L7.54764 9.62136L5.58892 7.66984C5.37262 7.45166 5.03615 7.4759 4.81985 7.66984C4.60355 7.88802 4.62758 8.22742 4.81985 8.4456L7.01891 10.6153C7.16311 10.7608 7.35538 10.8335 7.54764 10.8335C7.73991 10.8335 7.93218 10.7608 8.07638 10.6153L11.8376 6.2759C12.0539 6.05772 12.0539 5.71833 11.8376 5.50014C11.6213 5.28196 11.2848 5.28196 11.0685 5.4759Z" fill="#34C759"/>
	`;
const checkIcon = `
		<svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M8 1.83333C4.3181 1.83333 1.33333 4.8181 1.33333 8.5C1.33333 12.1819 4.3181 15.1667 8 15.1667C11.6819 15.1667 14.6667 12.1819 14.6667 8.5C14.6667 4.8181 11.6819 1.83333 8 1.83333ZM0 8.5C0 4.08172 3.58172 0.5 8 0.5C12.4183 0.5 16 4.08172 16 8.5C16 12.9183 12.4183 16.5 8 16.5C3.58172 16.5 0 12.9183 0 8.5Z" fill="#8A8888"></path>
		<path d="M11.0688 5.9759L7.54789 10.1214L5.58916 8.16984C5.37286 7.95166 5.03639 7.9759 4.82009 8.16984C4.60379 8.38802 4.62783 8.72742 4.82009 8.9456L7.01915 11.1153C7.16335 11.2608 7.35562 11.3335 7.54789 11.3335C7.74016 11.3335 7.93242 11.2608 8.07662 11.1153L11.8379 6.7759C12.0542 6.55772 12.0542 6.21833 11.8379 6.00014C11.6216 5.78196 11.2851 5.78196 11.0688 5.9759Z" fill="#8A8888"></path>
		</svg>`;
const plusIcon = `
		<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M8.00016 3.16669C8.36835 3.16669 8.66683 3.46516 8.66683 3.83335V13.1667C8.66683 13.5349 8.36835 13.8334 8.00016 13.8334C7.63197 13.8334 7.3335 13.5349 7.3335 13.1667V3.83335C7.3335 3.46516 7.63197 3.16669 8.00016 3.16669Z" fill="#787C82"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M2.6665 8.49998C2.6665 8.13179 2.96498 7.83331 3.33317 7.83331H12.6665C13.0347 7.83331 13.3332 8.13179 13.3332 8.49998C13.3332 8.86817 13.0347 9.16665 12.6665 9.16665H3.33317C2.96498 9.16665 2.6665 8.86817 2.6665 8.49998Z" fill="#787C82"/>
		</svg>`;
const minusIcon = `
		<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M2.6665 8.49998C2.6665 8.13179 2.96498 7.83331 3.33317 7.83331H12.6665C13.0347 7.83331 13.3332 8.13179 13.3332 8.49998C13.3332 8.86817 13.0347 9.16665 12.6665 9.16665H3.33317C2.96498 9.16665 2.6665 8.86817 2.6665 8.49998Z" fill="#787C82"/>
		</svg>`;
const loading = item => {
  if (item === 'course' && !courseIcon.querySelector('.loader')) {
    courseIcon.innerHTML = `<div class="loader">`;
  }
  if (item === 'section' && !sectionIcon.querySelector('.loader')) {
    sectionIcon.innerHTML = `<div class="loader">`;
  }
  if (item === 'course_item' && !courseItemIcon.querySelector('.loader')) {
    courseItemIcon.innerHTML = `<div class="loader">`;
  }
  if (item === 'question' && !questionIcon.querySelector('.loader')) {
    questionIcon.innerHTML = `<div class="loader">`;
  }
};
const migrate = (paged = 1, item = 'course') => {
  loading(item);
  const number = 50;
  wp.apiFetch({
    path: '/' + restNamespace + '/migrate/tutor',
    method: 'POST',
    data: {
      paged,
      number,
      item
    }
  }).then(res => {
    if (res.status && res.status === 'success') {
      if (item === 'course') {
        const migratedCourse = res?.data?.migrated_course_total;
        const percentage = (migratedCourse / courseTotal * 100).toFixed(0);
        coursePbNode.style.width = `${percentage}%`;
        migratedCourseTotal.innerHTML = migratedCourse;
        if (res?.data?.next_migrate_item && res?.data?.next_migrate !== 'course') {
          courseIcon.innerHTML = checkedIcon;
        }
      }
      if (item === 'section') {
        const migratedSection = res?.data?.migrated_section_total;
        const percentage = (migratedSection / sectionTotal * 100).toFixed(0);
        sectionPbNode.style.width = `${percentage}%`;
        migratedSectionTotal.innerHTML = migratedSection;
        if (res?.data?.next_migrate_item && res?.data?.next_migrate_item !== 'section') {
          sectionIcon.innerHTML = checkedIcon;
        }
      }
      if (item === 'course_item') {
        const migratedCourseItem = res?.data?.migrated_course_item_total;
        const percentage = (migratedCourseItem / courseItemTotal * 100).toFixed(0);
        courseItemPbNode.style.width = `${percentage}%`;
        migratedCourseItemTotal.innerHTML = migratedCourseItem;
        if (res?.data?.next_migrate_item && res?.data?.next_migrate_item !== 'course_item') {
          courseItemIcon.innerHTML = checkedIcon;
        }
      }
      if (item === 'question') {
        const migratedQuestion = res?.data?.migrated_question_total;
        const percentage = (migratedQuestion / questionTotal * 100).toFixed(0);
        questionPbNode.style.width = `${percentage}%`;
        migratedQuestionTotal.innerHTML = migratedQuestion;
        if (res?.data?.next_migrate_item && res?.data?.next_migrate_item !== 'question') {
          questionIcon.innerHTML = checkedIcon;
        }
      }
      if (item === 'course_process') {
        const migratedCourseProcess = res?.data?.migrated_course_process_total;
        const percentage = (migratedCourseProcess / courseProcessTotal * 100).toFixed(0);
        coursePcPbNode.style.width = `${percentage}%`;
        migratedProcessCourseTotal.innerHTML = migratedCourseProcess;
        if (res?.data?.next_migrate_item === false) {
          learnProgressIcon.innerHTML = checkedIcon;
        }
      }
      if (res?.data?.next_migrate_item) {
        migrate(res?.data?.next_page, res?.data?.next_migrate_item);
      } else {
        statusNode.innerHTML = res.msg;
        statusNode.classList.add(`lp-migration-success`);
        // autoMigrateBtn.disabled = false;
        clearDataBtn.disabled = false;
        setTimeout(() => {
          displayMigrateSuccessPopup(res.data);
        }, 1000);
      }
    } else {
      statusNode.innerHTML = res.msg;
      statusNode.classList.add('lp-migration-error');
    }
  }).catch(err => {
    console.log(err);
  }).finally(() => {});
};
const displayMigrateSuccessPopup = data => {
  if (!migrateSuccessPopup) {
    return;
  }
  const result = migrateSuccessPopup.querySelector('.migrate-result');
  result.innerHTML = data.migrate_success_html;
  migrateSuccessPopup.classList.add('active');
  bodyNode.classList.add('lp-no-scroll');
};
const handleAfterMigrate = () => {
  if (!migrateSuccessPopup) {
    return;
  }
  const removePopupBtn = migrateSuccessPopup.querySelector('a.remove-popup');
  removePopupBtn.addEventListener('click', function () {
    migrateSuccessPopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
  });
  const bgOverlay = migrateSuccessPopup.querySelector('.bg-overlay');
  bgOverlay.addEventListener('click', function () {
    migrateSuccessPopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
  });
  const viewReportBtn = migrateSuccessPopup.querySelector('.view-report');
  viewReportBtn.addEventListener('click', function (event) {
    event.preventDefault();
    migrateSuccessPopup.classList.remove('active');
    bodyNode.classList.remove('lp-no-scroll');
    // window.location.hash = '#migration-report';
    window.location.reload();
  });
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (migrateTutor);

/***/ }),

/***/ "@wordpress/url":
/*!*****************************!*\
  !*** external ["wp","url"] ***!
  \*****************************/
/***/ ((module) => {

module.exports = window["wp"]["url"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!****************************************************!*\
  !*** ./assets/src/js/admin/lp-migration-tutor.tsx ***!
  \****************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _tutor_migration__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./tutor/migration */ "./assets/src/js/admin/tutor/migration.js");

document.addEventListener('DOMContentLoaded', event => {
  (0,_tutor_migration__WEBPACK_IMPORTED_MODULE_0__["default"])();
});
})();

/******/ })()
;
//# sourceMappingURL=lp-migration-tutor.js.map