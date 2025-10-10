document.addEventListener('DOMContentLoaded', () => {
    
    let state = {};
    
    const valueSymbols = {
        'SKIP': '🚫',
        'REV': '🔄',
        '+2': '+2',
        'WILD': '🎨',
        '+4': '+4'
    };

    const elements = {
        controlPanel: document.getElementById('control-panel'),
        colorPickerModal: document.getElementById('color-picker-modal'),
        unoAlert: document.getElementById('uno-alert'),
        balance: document.getElementById('balance'),
        gameMessages: document.getElementById('game-messages'),
        botHandDisplay: document.getElementById('bot-hand-display'),
        botCardCount: document.getElementById('bot-card-count'),
        playerHandDisplay: document.getElementById('player-hand-display'),
        playerCardCount: document.getElementById('player-card-count'),
        topCardContainer: document.getElementById('top-card-container'),
        deckPile: document.getElementById('deck-pile'),
        betInput: document.getElementById('bet-input'),
        startRoundBtn: document.getElementById('start-round-btn'),
        passTurnBtn: document.getElementById('pass-turn-btn'),
        unoBtn: document.getElementById('uno-btn'),
        callUnoBtn: document.getElementById('call-uno-btn'),
        colorOptions: document.querySelector('.color-options'),
    };

    function getCardImageUrl(card) {
        let color = card.color.toLowerCase();
        let value = card.value.toUpperCase();

        if (value === 'WILD') return 'assets/cards/wild.png';
        if (value === '+4') return 'assets/cards/plus_4.png';

        value = value.replace('+', 'plus').toLowerCase();
        return `assets/cards/${color}_${value}.png`;
    }

    function initializeGame() {
    // Jangan reset saldo, biarkan tetap lanjut
    const lastBalance = state.balance || 5000;
    state = {
        ...state, // simpan properti lama
        balance: lastBalance, // pertahankan saldo terakhir
        deck: [],
        playerHand: [],
        botHand: [],
        discardPile: [],
        turn: 'player',
        gameInProgress: false,
        activeColor: null,
        unoCallTimer: null,
        playerUnoCalled: false,
    };
    logMessage({ text: 'Klik "Mulai Ronde" untuk bermain.' });
    updateUI();
    }


    function startRound() {
        const bet = parseInt(elements.betInput.value);
        if (isNaN(bet) || bet < 100) {
            alert('Taruhan minimal $100');
            return;
        }
        if (bet > state.balance) {
            alert('Saldo tidak mencukupi!');
            return;
        }
        
        state.bet = bet;
        state.gameInProgress = true;
        state.deck = createDeck();
        shuffle(state.deck);
        state.playerHand = dealCards(7);
        state.botHand = dealCards(7);
        let firstCard;
        do {
            if (state.deck.length === 0) {
                state.deck = createDeck();
                shuffle(state.deck);
            }
            firstCard = state.deck.pop();
        } while (firstCard.color === 'black');
        
        state.discardPile.push(firstCard);
        state.activeColor = firstCard.color;
        state.turn = 'player';
        logMessage({ text: `Ronde dimulai. Giliran Anda.` });
        updateUI();
    }

    function createDeck() {
        const colors = ['red', 'yellow', 'green', 'blue'];
        let deck = [];
        for (const color of colors) {
            deck.push({ color, value: '0' });
            for (let i = 1; i < 10; i++) {
                deck.push({ color, value: i.toString() });
                deck.push({ color, value: i.toString() });
            }
            ['SKIP', 'REV', '+2'].forEach(type => {
                deck.push({ color, value: type });
                deck.push({ color, value: type });
            });
        }
        for (let i = 0; i < 4; i++) {
            deck.push({ color: 'black', value: 'WILD' });
            deck.push({ color: 'black', value: '+4' });
        }
        return deck;
    }

    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function dealCards(num) {
        let hand = [];
        for (let i = 0; i < num; i++) {
            if(state.deck.length === 0) refillDeck();
            hand.push(state.deck.pop());
        }
        return hand;
    }

    function isCardPlayable(card) {
        const topCard = state.discardPile[state.discardPile.length - 1];
        return card.color === 'black' || card.color === state.activeColor || card.value === topCard.value;
    }

    function playCard(cardIndex, playedBy) {
        const hand = (playedBy === 'player') ? state.playerHand : state.botHand;
        if (state.turn !== playedBy) return;

        const card = hand[cardIndex];
        if (!isCardPlayable(card)) {
            if(playedBy === 'player') alert('Kartu tidak cocok! Ambil kartu terlebih dahulu atau lewati giliran.');
            return;
        }

        hand.splice(cardIndex, 1);
        state.discardPile.push(card);
        state.activeColor = card.color;

        clearTimeout(state.unoCallTimer);
        elements.unoAlert.style.display = 'none';
        if (hand.length === 1) {
            startUnoTimer(playedBy);
        }
        state.playerUnoCalled = false;

        handleCardEffect(card, playedBy);
    }

    function handleCardEffect(card, playedBy) {
        const nextTurnPlayer = playedBy === 'player' ? 'bot' : 'player';
        const playerName = playedBy === 'player' ? 'Anda' : 'Bot';
        const nextPlayerName = nextTurnPlayer === 'player' ? 'Anda' : 'Bot';

        if (card.color === 'black') {
            if (playedBy === 'player') {
                logMessage({ text: `Anda memainkan. <br>Pilih warna...`, card: card });
                elements.colorPickerModal.style.display = 'flex';
            } else { 
                state.activeColor = getBestColorForBot();
                let message = `Bot memilih warna ${state.activeColor}.`;
                if (card.value === '+4') {
                    applyDraw(4, 'player');
                    message += `<br>Giliran Bot lagi.`;
                } else {
                    message += `<br>Giliran Anda.`;
                }
                logMessage({ text: message, card: card });
                setTimeout(() => switchTurn(card.value === '+4' ? playedBy : nextTurnPlayer), 1000);
            }
        } else { 
            let turnSkipped = false;
            let message = `${playerName} memainkan.`;

            if (card.value === '+2') {
                applyDraw(2, nextTurnPlayer);
                message += `<br>${nextPlayerName} mengambil 2 kartu. Giliran ${playerName} lagi.`;
                turnSkipped = true;
            } else if (card.value === 'SKIP' || card.value === 'REV') {
                message += `<br>Giliran ${nextPlayerName} dilewati. Giliran ${playerName} lagi.`;
                turnSkipped = true;
            } else {
                message += `<br>Giliran ${nextPlayerName}.`;
            }

            logMessage({ text: message, card: card });

            setTimeout(() => {
                switchTurn(turnSkipped ? playedBy : nextTurnPlayer);
            }, 800);
        }
        updateUI();
    }

    function applyDraw(count, targetPlayer) {
        const hand = targetPlayer === 'player' ? state.playerHand : state.botHand;
        for(let i=0; i<count; i++) {
            if (state.deck.length === 0) refillDeck();
            hand.push(state.deck.pop());
        }
    }

    function switchTurn(nextPlayer) {
        state.turn = nextPlayer;
        updateUI();
        if (state.turn === 'bot') {
            setTimeout(botTurn, 1500);
        }
    }

    function botTurn() {
        const playableCards = state.botHand.map((card, index) => ({card, index}))
                                          .filter(item => isCardPlayable(item.card));
        if (playableCards.length > 0) {
            const choice = playableCards[0];
            playCard(choice.index, 'bot');
        } else {
            logMessage({ text: 'Bot mengambil kartu.<br>Giliran Anda.' });
            if (state.deck.length === 0) refillDeck();
            state.botHand.push(state.deck.pop());
            switchTurn('player');
        }


        if (state.botHand.length === 1) {
            if (Math.random() < 0.5) {
                state.botUnoCalled = true;
                logMessage({ text: 'BOT: UNO!' });
            } else {
                state.botUnoCalled = false;
                logMessage({ text: 'BOT lupa memanggil UNO!' });
            }
        }

        updateUI();
    }

    function startUnoTimer(player) {
        if(player !== 'player') return;
        let timeLeft = 5;
        state.playerUnoCalled = false;
        elements.unoAlert.textContent = `UNO! Anda harus mengatakan UNO! Waktu tersisa: ${timeLeft}`;
        elements.unoAlert.style.display = 'block';
        state.unoCallTimer = setInterval(() => {
            timeLeft--;
            elements.unoAlert.textContent = `UNO! Anda harus mengatakan UNO! Waktu tersisa: ${timeLeft}`;
            if (timeLeft <= 0) {
                clearInterval(state.unoCallTimer);
                elements.unoAlert.style.display = 'none';
                if (!state.playerUnoCalled) {
                    alert('Terlambat! Anda tidak memanggil UNO. Penalti +2 kartu.');
                    applyDraw(2, 'player');
                    updateUI();
                }
            }
        }, 1000);
    }

    function refillDeck() {
        const top = state.discardPile.pop();
        state.deck = [...state.discardPile];
        state.discardPile = [top];
        shuffle(state.deck);
    }

    function getBestColorForBot() {
        const colorCount = {red:0, yellow:0, green:0, blue:0};
        state.botHand.forEach(c => {
            if(c.color !== 'black') colorCount[c.color]++;
        });
        return Object.keys(colorCount).reduce((a, b) => colorCount[a] > colorCount[b] ? a : b);
    }

    function logMessage({ text, card = null }) {
        if (!text) return;
        
        elements.gameMessages.innerHTML = '';

        const logEntry = document.createElement('div');
        logEntry.className = 'log-entry';

        let html = `<span>${text}</span>`;
        if (card) {
            const symbol = valueSymbols[card.value] || card.value;
            const isSymbolClass = valueSymbols[card.value] ? 'is-symbol' : '';
            const miniCardHTML = `<div class="mini-card ${card.color} ${isSymbolClass}">${symbol}</div>`;
            html = `${miniCardHTML} ${html}`;
        }
        
        logEntry.innerHTML = html;
        elements.gameMessages.appendChild(logEntry);
    }

    function updateUI() {
        elements.balance.textContent = `$${state.balance}`;
        elements.startRoundBtn.disabled = state.gameInProgress;
        elements.passTurnBtn.disabled = !state.gameInProgress || state.turn !== 'player';
        renderHand(state.playerHand, elements.playerHandDisplay, true);
        renderHand(state.botHand, elements.botHandDisplay, false);
        elements.playerCardCount.textContent = state.playerHand.length;
        elements.botCardCount.textContent = state.botHand.length;

        elements.deckPile.innerHTML = `<img src="assets/cards/card_back.png" class="card-img" alt="Deck">`;

        elements.topCardContainer.innerHTML = '';
        if (state.discardPile.length > 0) {
            const topCard = state.discardPile[state.discardPile.length - 1];
            const cardEl = createCardElement(topCard, true);
            elements.topCardContainer.appendChild(cardEl);
        }

        if (state.gameInProgress && (state.playerHand.length === 0 || state.botHand.length === 0)) {
            state.gameInProgress = false;
            const playerWon = state.playerHand.length === 0;
            state.balance += playerWon ? state.bet : -state.bet;
            setTimeout(() => {
                alert(`Anda ${playerWon ? 'menang' : 'kalah'} ronde ini! ${playerWon ? '+' : '-'}$${state.bet}`);
                initializeGame();
            }, 500);
        }
    }

    function renderHand(hand, container, isPlayer) {
        container.innerHTML = '';
        hand.forEach((card, index) => {
            const el = isPlayer ? createCardElement(card, false, index) : createCardBackElement();
            if(isPlayer && isCardPlayable(card) && state.turn === 'player') {
                el.classList.add('playable');
            }
            container.appendChild(el);
        });
    }

    function createCardElement(card, isTopCard, index) {
        const el = document.createElement('div');
        el.className = `card ${card.color}`;
        el.dataset.index = index;
        const imgSrc = getCardImageUrl(card);
        el.innerHTML = `<img class="card-img" src="${imgSrc}" alt="${card.color} ${card.value}" onerror="this.style.display='none'">`;

        if(!isTopCard) {
            el.addEventListener('click', () => playCard(parseInt(el.dataset.index), 'player'));
        }
        return el;
    }

    function createCardBackElement() {
        const el = document.createElement('div');
        el.className = 'card-back';
        el.innerHTML = `<img class="card-img" src="assets/cards/card_back.png" alt="UNO card back">`;
        return el;
    }

    // tombol
    elements.startRoundBtn.addEventListener('click', startRound);
    elements.deckPile.addEventListener('click', () => {
        if (state.turn === 'player' && state.gameInProgress) {
            if (state.deck.length === 0) refillDeck();
            state.playerHand.push(state.deck.pop());
            logMessage({ text: 'Anda mengambil 1 kartu.' });
            updateUI();
        }
    });
    elements.passTurnBtn.addEventListener('click', () => {
        if(state.turn === 'player' && state.gameInProgress) {
            switchTurn('bot');
        }
    });
    elements.unoBtn.addEventListener('click', () => {
        if (state.playerHand.length === 1 && state.unoCallTimer) {
            state.playerUnoCalled = true;
            clearInterval(state.unoCallTimer);
            elements.unoAlert.style.display = 'none';
            logMessage({ text: 'ANDA: UNO!' });

            setTimeout(() => {
                if (state.playerHand.length === 1 && state.botHand.length > 1) {
                    state.gameInProgress = false;
                    state.balance += state.bet;
                    logMessage({ text: `UNO! Anda menang otomatis karena bot tidak memanggil UNO! 🏆 +$${state.bet}` });
                    setTimeout(() => {
                        alert(`UNO! Anda menang otomatis! +$${state.bet}`);
                        initializeGame();
                    }, 1000);
                }
            }, 5000);
        }
    });

    elements.callUnoBtn.addEventListener('click', () => {
        if (state.botHand.length === 1 && !state.botUnoCalled) {
            state.gameInProgress = false;
            state.balance += state.bet;
            logMessage({ text: `Anda memanggil UNO terhadap bot yang lupa! 🏆 Anda menang otomatis! +$${state.bet}` });
            setTimeout(() => {
                alert(`Bot lupa memanggil UNO! Anda menang otomatis! +$${state.bet}`);
                initializeGame();
            }, 1000);
        } else {
            logMessage({ text: 'Bot tidak lupa UNO atau tidak tinggal 1 kartu. Tidak ada efek.' });
        }
    });

    elements.colorOptions.addEventListener('click', (e) => {
        if(e.target.matches('.color-btn')) {
            const color = e.target.dataset.color;
            const wildCard = state.discardPile[state.discardPile.length - 1];
            state.activeColor = color;
            
            elements.colorPickerModal.style.display = 'none';
            
            let turnSkipped = wildCard.value === '+4';
            let nextPlayer = turnSkipped ? 'player' : 'bot';
            let message = `Anda memilih warna ${color}.`;
            
            if (turnSkipped) {
                applyDraw(4, 'bot');
                message += `<br>Giliran Anda lagi.`;
            } else {
                message += `<br>Giliran Bot.`;
            }

            logMessage({ text: message });
            switchTurn(nextPlayer);
        }
    });

    initializeGame();
});
