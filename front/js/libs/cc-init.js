const config = {  
    gui_options: {
      consent_modal: {
          layout: 'cloud',               // box/cloud/bar
          position: 'bottom center',     // bottom/middle/top + left/right/center
          transition: 'slide',           // zoom/slide
          swap_buttons: false            // enable to invert buttons
      },
      settings_modal: {
          layout: 'box',                 // box/bar
          // position: 'left',           // left/right
          transition: 'slide'            // zoom/slide
      }
    },
    current_lang: "th",
    autorun: true,
    force_consent : true,
    cookie_expiration : 1,
    autoclear_cookies: true,
    languages: {
      en: {
        consent_modal: {

          title: "นโยบายการใช้คุ้กกี้ (Cookies)!",
          description:
            'เราใช้คุกกี้เพื่อพัฒนาประสิทธิภาพ และประสบการณ์ที่ดีในการใช้เว็บไซต์ของคุณ คุณสามารถศึกษารายละเอียดได้ที่ นโยบายคุ้กกี้ และสามารถจัดการความเป็นส่วนตัวเองได้ของคุณได้เองโดยคลิกที่ปุ่มตั้งค่า <button type="button" data-cc="c-settings" class="cc-link">ตั้งค่า</button>'+
            '<br>Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent. <button type="button" data-cc="c-settings" class="cc-link">Setting</button>',
          primary_btn: {
            text: "ยินยอม",
            role: "accept_all", // 'accept_selected' or 'accept_all'
          },
          // secondary_btn: {
          //   text: "Reject all",
          //   role: "accept_necessary", // 'settings' or 'accept_necessary'
          // },
        },
        settings_modal: {
          title: "Cookie preferences",
          save_settings_btn: "Save settings",
          accept_all_btn: "Accept",
          // reject_all_btn: "Reject all",
          close_btn_label: "Close",
          cookie_table_headers: [
            { col1: "Name" },
            { col2: "Domain" },
            { col3: "Expiration" },
            { col4: "Description" },
          ],
          blocks: [
            {
              title: "Cookie usage 📢",
              description:
                'เราใช้คุกกี้เพื่อพัฒนาประสิทธิภาพ และประสบการณ์ที่ดีในการใช้เว็บไซต์ของคุณ คุณสามารถศึกษารายละเอียดได้ที่ นโยบายคุ้กกี้ และสามารถจัดการความเป็นส่วนตัวเองได้ของคุณได้เองโดยคลิกที่ปุ่มตั้งค่า'+
                '<br>I use cookies to ensure the basic functionalities of the website and to enhance your online experience. You can choose for each category to opt-in/out whenever you want. For more details relative to cookies and other sensitive data, please read the full <a href="#" class="cc-link">privacy policy</a>.',
            },
            {
              title: "Strictly necessary cookies",
              description:
                "These cookies are essential for the proper functioning of my website. Without these cookies, the website would not work properly",
              toggle: {
                value: "necessary",
                enabled: true,
                readonly: true, // cookie categories with readonly=true are all treated as "necessary cookies"
              },
            },
            {
              title: "Performance and Analytics cookies",
              description:
                "These cookies allow the website to remember the choices you have made in the past",
              toggle: {
                value: "analytics", // your cookie category
                enabled: false,
                readonly: false,
              },
              cookie_table: [
                // list of all expected cookies
                {
                  col1: "^_ga", // match all cookies starting with "_ga"
                  col2: "elibrary.psu.ac.th",
                  col3: "1 day",
                  col4: "description ...",
                  is_regex: true,
                },
                {
                  col1: "_gid",
                  col2: "elibrary.psu.ac.th",
                  col3: "1 day",
                  col4: "description ...",
                },
              ],
            },
            {
              title: "More information",
              description:
                'For any queries in relation to our policy on cookies and your choices, please <a class="cc-link" href="#yourcontactpage">contact us</a>.',
            },
            {
              title: "Reject",
              description:
                '<a type="button" onclick="window.location.reload();">Reject All</a>',
            },
          ]
        },
      },
    },



    onFirstAction: function(user_preferences, cookie){
      console.log('User accept type:', user_preferences.accept_type);
      console.log('User accepted these categories', user_preferences.accepted_categories);
      console.log('User reject these categories:', user_preferences.rejected_categories);
      if(user_preferences.accept_type!="all"){
        
      }
    }
  };


let cc = initCookieConsent();
cc.run(config);
