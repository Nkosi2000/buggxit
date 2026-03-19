// tests/e2e/edge-homepage.js
module.exports = {
  '@tags': ['edge'],
  
  before: function(browser) {
    console.log('Testing with Microsoft Edge browser');
  },
  
  'Laravel loads in Edge': function(browser) {
    browser
      .url(process.env.APP_URL || 'http://localhost:8000')
      .waitForElementVisible('body', 5000)
      .assert.titleContains('Laravel')
      .assert.visible('#app')
      .takeEdgeScreenshot('homepage-loaded.png')
      .assert.containsText('h1', 'Laravel');
  },
  
  'Edge handles JavaScript correctly': function(browser) {
    browser
      .execute(function() {
        // Test JavaScript execution in Edge
        document.title = 'Laravel - Test';
        return document.title;
      }, [], function(result) {
        browser.assert.equal(result.value, 'Laravel - Test');
      })
      .execute(function() {
        // Reset title
        document.title = 'Laravel';
      });
  },
  
  'Edge navigation works': function(browser) {
    browser
      .url(process.env.APP_URL || 'http://localhost:8000')
      .useIEMode()  // Using our custom command
      .click('a[href*="docs"]')
      .pause(1000)
      .assert.urlContains('docs')
      .back()
      .click('a[href*="github"]')
      .pause(1000)
      .assert.urlContains('github');
  },
  
  after: function(browser) {
    browser.end();
  }
};