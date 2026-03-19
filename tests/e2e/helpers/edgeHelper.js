// tests/e2e/helpers/edgeHelper.js
module.exports = {
  commands: [{
    /**
     * Edge-specific command to simulate IE mode (if needed)
     */
    useIEMode: function() {
      return this.execute(function() {
        // Edge-specific JavaScript if needed
        if (window.navigator.userAgent.includes('Edg')) {
          console.log('Running in Microsoft Edge');
        }
      });
    },
    
    /**
     * Take screenshot with Edge timestamp
     */
    takeEdgeScreenshot: function(filename) {
      const timestamp = new Date().toISOString().replace(/[:.]/g, '-');
      return this.saveScreenshot(`edge-${timestamp}-${filename}`);
    },
    
    /**
     * Clear Edge browsing data
     */
    clearEdgeData: function() {
      return this.executeAsync(function(done) {
        // This would need Edge-specific APIs if available
        // Currently a placeholder for custom Edge operations
        done();
      });
    }
  }]
};