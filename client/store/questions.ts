import {ActionTree, GetterTree, MutationTree} from 'vuex'
import {State} from "nuxt-property-decorator";
import {Deck, Question} from "~/types/app";

type State = {
  deck: Deck
}

const state = () => ({})

const getters: GetterTree<State, State> = {
  deck(state): Deck {
    return state.deck
  }
}

const mutations: MutationTree<State> = {
  init(state: State, deck: Deck) {
    state.deck = deck
  }
}

const actions: ActionTree<State, any> = {
  async load({commit}) {
    //llamar a la api
    const list = [
      {id: '01', question: 'cama', answer: 'bed', audio: '/audio/en/uk/general/en007269.mp3', status: null},
      {id: '02', question: 'club', answer: 'club', audio: '/audio/en/uk/general/en016109.mp3', status: null},
      {id: '03', question: 'motor', answer: 'engine', audio: '/audio/en/uk/general/en029903.mp3', status: null},
      {id: '04', question: 'familia', answer: 'family', audio: '/audio/en/uk/general/en032779.mp3', status: null},
      {id: '05', question: 'fútbol', answer: 'football', audio: '/audio/en/uk/general/en035612.mp3', status: null},
      {id: '06', question: 'uno', answer: 'one', audio: '/audio/en/uk/general/en059756.mp3', status: null},
      {id: '07', question: 'mucho/a', answer: 'plenty', audio: '/audio/en/uk/general/en064650.mp3', status: null},
      {id: '08', question: 'pobre, humilde', answer: 'poor', audio: '/audio/en/uk/general/en065335.mp3', status: null},
      {id: '09', question: 'piel', answer: 'skin', audio: '/audio/en/uk/general/en079567.mp3', status: null},
      {id: '10', question: 'peligro', answer: 'danger', audio: '/audio/en/uk/general/en022326.mp3', status: null},
    ];

    const questions: Question[] = list.map((input) => {
      return new Question({id : input.id, question : input.question, answer : input.answer, audio : input.audio})
    })

    commit("init", new Deck(questions))
  },

  async solve({commit}, payload) {
    console.log(payload, '<<<<')
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
