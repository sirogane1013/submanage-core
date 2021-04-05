import { BIconBasket, BIconBook, BIconCameraReels, BIconChatDots, BIconController, BIconMusicNote, BIconNewspaper, BIconQuestion, BIconShop, BIconBarChart } from "bootstrap-vue";

export default {
    state: {
        isLoggedIn: false,
    },
    data: {
        categories: [
            {
                text: '未分類',
                value: null,
                icon: BIconQuestion,
            }, 
            {
                text: '動画',
                value: 1,
                icon: BIconCameraReels,
            },
            {
                text: '食事',
                value: 2,
                icon: BIconBasket,
            },
            {
                text: 'ショッピング',
                value: 3,
                icon: BIconShop,
            },
            {
                text: '音楽',
                value: 4,
                icon: BIconMusicNote,
            },
            {
                text: '本/雑誌',
                value: 5,
                icon: BIconBook,
            },
            {
                text: 'ソーシャル',
                value: 6,
                icon: BIconChatDots,
            },
            {
                text: '仕事',
                value: 7,
                icon: BIconBarChart,
            },
            {
                text: 'ゲーム',
                value: 8,
                icon: BIconController,
            },
            {
                text: '情報',
                value: 9,
                icon: BIconNewspaper,
            },
        ],
    },
    login() {
        this.state.isLoggedIn = true;
    },
    logout() {
        this.state.isLoggedIn = false;
    },
}