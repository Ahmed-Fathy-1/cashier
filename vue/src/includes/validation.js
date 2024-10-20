import {
  Form as VeeForm,
  Field as VeeField,
  defineRule,
  ErrorMessage,
  configure
} from 'vee-validate'
import {
  required,
  min,
  max,
  alpha,
  alpha_spaces as alphaSpaces,
  email,
  min_value as minVal,
  max_value as maxVal,
  confirmed,
  is_not as excluded
} from '@vee-validate/rules'

export default {
  install(app) {
    app.component('VeeForm', VeeForm)
    app.component('VeeField', VeeField)
    app.component('ErrorMessage', ErrorMessage)

    defineRule('required', required)
    defineRule('term_condition', required)
    defineRule('min', min)
    defineRule('max', max)
    defineRule('alpha', alpha)
    defineRule('alpha_spaces', alphaSpaces)
    defineRule('email', email)
    defineRule('min_value', minVal)
    defineRule('max_value', maxVal)
    defineRule('passwords_mismatch', confirmed)
    defineRule('excluded', excluded)

    configure({
      generateMessage: (ctx) => {
        const messages = {
          required: `The field ${ctx.field} is required.`,
          min: `The field ${ctx.field} is is too short.`,
          max: `The field ${ctx.field} is is too long.`,
          alpha: `The field ${ctx.field} may only contain alphabetical charachters.`,
          alpha_spaces: `The field ${ctx.field} may only contain alphabetical charachters and spaces.`,
          email: `The field ${ctx.field} must be a valid email.`,
          min_value: `The filed ${ctx.field} is too low`,
          max_value: `The filed ${ctx.field} is too high`,
          excluded: `You are nnot allowed to use this value for the field ${ctx.field}`,
          passwords_mismatch: `The passwords don't match.`,
          term_condition: `You must accept the terms of service.`
        }
        const message = messages[ctx.rule.name]
          ? messages[ctx.rule.name]
          : `The field ${ctx.field} is invalid.`

        return message
      },
      validateOnBlur: true,
      validateOnChange: true,
      validateOnInput: false,
      validateOnModelUpdate: true
    })
  }
}
