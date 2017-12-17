import styled, {css} from 'styled-components';
import TextField from 'material-ui/TextField';

const bg = '/img/login.jpeg';
const rowMixin = css`
  width: calc(100% - 20px);
  max-width: 374px;
  margin-bottom: 20px !important;
`;

export const LoginWrapper = styled.form`
  width: 100%;
  height: 100vh;
  max-width: 600px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  background: url(${bg});
`;

export const Row = styled.div`
  ${rowMixin}
  img {
    vertical-align: bottom;
    float: right;
  }
`;

export const StyledTextField = styled(TextField)`
  ${rowMixin}

  &:first-child {
    margin-top: -40px;
  }
`;

export const ErrText = styled.div`
  color: red;
  text-align: left;
`;