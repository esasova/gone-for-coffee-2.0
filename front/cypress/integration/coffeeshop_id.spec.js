describe('Coffeeshop_id Page Tests', () => {
  beforeEach(() => {
    cy.intercept('GET', '**/api/coffeeshops/**', { fixture: 'coffeeshop_detail.json' })
  })
  it('Visits the coffeeshop_id page', () => {
    cy.visit('/coffeeshops/1')
  })

  it('Checks if the name of coffeeshop is Coffee House', () => {
    cy.get('[data-test="coffeeshop_detail_name"]').contains('Coffee House')
  })
})
