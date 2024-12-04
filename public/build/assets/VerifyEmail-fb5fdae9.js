import{v as _,z as g,o as n,d as f,b as o,u as t,X as h,w as i,a,t as s,g as b,n as v,e as r,x as m,p as x,F as k}from"./app-9cb26ff6.js";import{_ as y}from"./AuthenticationCard-4227316f.js";import{_ as w}from"./AuthenticationCardLogo-a2386df2.js";import{_ as S}from"./PrimaryButton-0fb1f193.js";import"./SwitchLocale-b9e142e8.js";import"./SwitchDarkMode-e6f628a6.js";import"./index-afa3307c.js";import"./ApplicationLogo-914092fa.js";import"./_plugin-vue_export-helper-c27b6911.js";const V={class:"flex flex-col mb-4"},N={class:"text-primary font-semibold text-xl"},B={class:"text-slate-400"},C={key:0,class:"mb-4 font-medium text-sm text-green-600 dark:text-green-400"},$=["onSubmit"],z={class:"mt-4 flex flex-col gap-4 items-center justify-between"},G={__name:"VerifyEmail",props:{status:String},setup(c){const u=c,l=_({}),d=()=>{l.post(route("verification.send"))},p=g(()=>u.status==="verification-link-sent");return(e,E)=>(n(),f(k,null,[o(t(h),{title:e.lang().label.email_verification},null,8,["title"]),o(y,null,{logo:i(()=>[o(w)]),default:i(()=>[a("div",V,[a("h2",N,s(e.lang().label.verify_email),1),a("small",B,s(e.lang().label.verify_email_caption),1)]),t(p)?(n(),f("div",C,s(e.lang().label.email_verification_link),1)):b("",!0),a("form",{onSubmit:x(d,["prevent"])},[a("div",z,[o(S,{class:v({"opacity-25":t(l).processing}),disabled:t(l).processing},{default:i(()=>[r(s(e.lang().button.resend_email_verification_link)+" "+s(t(l).processing?"...":""),1)]),_:1},8,["class","disabled"]),a("div",null,[o(t(m),{href:e.route("profile.show"),class:"underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-slate-800"},{default:i(()=>[r(s(e.lang().label.edit_profile),1)]),_:1},8,["href"]),o(t(m),{href:e.route("logout"),method:"post",as:"button",class:"underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-slate-800 ml-2"},{default:i(()=>[r(s(e.lang().label.logout),1)]),_:1},8,["href"])])])],40,$)]),_:1})],64))}};export{G as default};