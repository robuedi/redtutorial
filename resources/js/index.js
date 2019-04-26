    import LessonContent from './modules/LessonContent';
    import CookieBar from './modules/CookieBar';
    import FeedbackMessage from './modules/FeedbackMessage';
    import MobileSidebarMenu from './modules/MobileSidebarMenu';
    import SignIn from './modules/SignIn';
    import hljs from './modules/libs/highlight.js/lib/highlight';
    import shell from './modules/libs/highlight.js/lib/languages/shell';
    import bash from './modules/libs/highlight.js/lib/languages/bash';
    import php from './modules/libs/highlight.js/lib/languages/php';
    // import hljs from './modules/libs/highlight.pack'

document.addEventListener('DOMContentLoaded', () => {

    let cookieBar = new CookieBar();
    cookieBar.load();

    let feedbackMessage = new FeedbackMessage();
    feedbackMessage.load();

    let mobileSidebarMenu = new MobileSidebarMenu();
    mobileSidebarMenu.load();

    let signIn = new SignIn();
    signIn.load();

    hljs.registerLanguage('php', php);
    hljs.registerLanguage('shell', shell);
    hljs.registerLanguage('bash', bash);
    hljs.initHighlightingOnLoad();

    let lessonContent = new LessonContent();
    // lessonContent.load();
});
