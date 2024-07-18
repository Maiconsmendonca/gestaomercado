import {useState} from 'react';
import Icon from './Icon';
import Nav from './Nav';

export default function Sidebar() {
    const [visible, setVisible] = useState(false);
    return (
        <nav className="absolute z-20 w-full">
            <Icon visible={ visible } setVisible={ setVisible } />
            <Nav visible={ visible } />
        </nav>
    );
}