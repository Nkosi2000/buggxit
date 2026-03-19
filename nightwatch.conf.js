// nightwatch.conf.js
module.exports = {
  // Where your tests are located
  src_folders: ['tests/e2e'],
  
  // Where output reports go
  output_folder: 'tests/_output',
  
  // WebDriver settings for Edge
  webdriver: {
    start_process: true,
    server_path: require('edgedriver').path,
    port: 9515,
    cli_args: ['--port=9515', '--verbose']
  },
  
  // Test settings
  test_settings: {
    default: {
      launch_url: process.env.APP_URL || 'http://localhost:8000',
      webdriver: {
        start_process: true,
        server_path: require('edgedriver').path,
        port: 9515,
        cli_args: ['--port=9515', '--verbose']
      },
      desiredCapabilities: {
        browserName: 'MicrosoftEdge',
        'ms:edgeOptions': {
          args: [
            '--headless',
            '--no-sandbox',
            '--disable-dev-shm-usage',
            '--disable-gpu',
            '--window-size=1920,1080',
            '--inprivate'  // Edge equivalent of incognito
          ]
        },
        acceptInsecureCerts: true
      },
      screenshots: {
        enabled: true,
        path: 'tests/_output/screenshots',
        on_failure: true,
        on_error: true
      }
    },
    
    edge: {
      desiredCapabilities: {
        browserName: 'MicrosoftEdge',
        'ms:edgeOptions': {
          args: process.env.CI ? [
            '--headless',
            '--no-sandbox',
            '--disable-dev-shm-usage',
            '--window-size=1920,1080',
            '--inprivate'
          ] : [
            '--window-size=1920,1080',
            '--inprivate'
          ]
        }
      }
    },
    
    // Keep other browsers as fallback if needed
    chrome: {
      desiredCapabilities: {
        browserName: 'chrome',
        'goog:chromeOptions': {
          args: process.env.CI ? [
            '--headless',
            '--no-sandbox',
            '--disable-dev-shm-usage',
            '--window-size=1920,1080'
          ] : [
            '--window-size=1920,1080'
          ]
        }
      }
    }
  }
};