"use strict";(self["webpackChunkelibrary_vue"]=self["webpackChunkelibrary_vue"]||[]).push([[111],{5111:function(t,o,e){e.r(o),e.d(o,{default:function(){return p}});var a=e(3396),n=e(7139);const c=(0,a._)("h1",null,"Authentication with OAuth2.0",-1),l={key:0},s={key:1};function u(t,o,e,u,i,r){return(0,a.wg)(),(0,a.iD)("div",null,[c,i.loggedIn?((0,a.wg)(),(0,a.iD)("div",l,[(0,a._)("h2",null,"Welcome, "+(0,n.zw)(i.user.name),1),(0,a._)("button",{onClick:o[0]||(o[0]=(...t)=>r.logout&&r.logout(...t))},"Logout")])):((0,a.wg)(),(0,a.iD)("div",s,[(0,a._)("button",{onClick:o[1]||(o[1]=(...t)=>r.login&&r.login(...t))},"Login with OAuth2.0")]))])}var i=e(4161),r={data(){return{loggedIn:!1,user:{}}},methods:{login(){window.location.href="https://oauth.psu.ac.th/?oauth=authorize&client_id=oauthpsu1647&response_type=code&scope=profilepsu&redirect_uri=https%3A%2F%2Fread.libx.psu.ac.th%2Fpsupassportcallback&respond_type=code"},logout(){i.Z.post("/api/logout").then((()=>{this.loggedIn=!1,this.user={}})).catch((t=>{console.log(t)}))},getUserData(t){console.log("Call header"),i.Z.defaults.headers.common["Access-Control-Allow-Origin"]="*";var o={method:"get",url:"https://oauth.psu.ac.th/?oauth=profile",headers:{authorization:"Bearer "+t}};(0,i.Z)(o).then((function(t){console.log(JSON.stringify(t.data))})).catch((function(t){console.log(t)}))},handleCallback(){const t=new URLSearchParams(window.location.search).get("code");console.log("code : "+t),t&&i.Z.post("https://oauth.psu.ac.th/?oauth=token",{code:t,redirect_uri:"https://read.libx.psu.ac.th/psupassportcallback",grant_type:"authorization_code",client_id:"oauthpsu1647",client_secret:"b3bbcf8a3bf47c7d3f02e562dfd382cc"}).then((t=>{const o=t.data.access_token;console.log(o),this.getUserData(o)})).catch((t=>{console.log(t)}))}},mounted(){this.handleCallback()}},h=e(89);const d=(0,h.Z)(r,[["render",u]]);var p=d}}]);
//# sourceMappingURL=111.a721133d.js.map