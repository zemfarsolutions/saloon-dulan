/**
 *
 * Scripts.js
 *
 * Initialization of the page scripts.
 *
 *
 */

class Scripts {
  constructor() {
    this._initCommon();
    this._initPages();
  }

  // Common plugins and overrides initialization
  _initCommon() {
    // common.js initialization
    if (typeof Common !== 'undefined') {
      let common = new Common();
    }
  }

  _initPages() {
    // account.settings.js initialization
    if (typeof AccountSettings !== 'undefined') {
      const accountSettings = new AccountSettings();
    }
    // dashboard.analysis.js initialization
    if (typeof Analysis !== 'undefined') {
      const analysis = new Analysis();
    }
    // communitylist.js initialization
    if (typeof Communitylist !== 'undefined') {
      const communityList = new Communitylist();
    }
    // services.database.js initialization
    if (typeof ServicesDatabase !== 'undefined') {
      const servicesDatabase = new ServicesDatabase();
    }
    // services.databaseadd.js initialization
    if (typeof ServicesDatabaseAdd !== 'undefined') {
      const servicesDatabaseAdd = new ServicesDatabaseAdd();
    }
    // services.databasedetail.js initialization
    if (typeof ServicesDatabaseDetail !== 'undefined') {
      const servicesDatabaseDetail = new ServicesDatabaseDetail();
    }
    // services.storage.js initialization
    if (typeof ServicesStorage !== 'undefined') {
      const servicesStorage = new ServicesStorage();
    }
    // support.docs.js initialization
    if (typeof SupportDocs !== 'undefined') {
      const supportDocs = new SupportDocs();
    }
    // support.ticketsdetail.js initialization
    if (typeof SupportTicketsDetail !== 'undefined') {
      const supportTicketsDetail = new SupportTicketsDetail();
    }
  }
}

(function () {
  // Disabling dropzone auto discover before DOMContentLoaded
  if (typeof Dropzone !== 'undefined') {
    Dropzone.autoDiscover = false;
  }
})();
