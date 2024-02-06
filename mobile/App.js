import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { StatusBar } from 'expo-status-bar';
import { View } from 'react-native';
import { PaperProvider } from 'react-native-paper';

import AuthScreen from './screens/Auth';
import NotesListScreen from './screens/NotesList';
import NoteEditorScreen from './screens/NoteEditor';

const Stack = createNativeStackNavigator();

export default function App() {
  return (
    <View>
        <PaperProvider>
            <NavigationContainer>
                <Stack.Screen name="Auth" component={AuthScreen} />
                <Stack.Screen name="List" component={NotesListScreen} />
                <Stack.Screen name="Editor" component={NoteEditorScreen} />
            </NavigationContainer>
        </PaperProvider>
        <StatusBar style="auto" />
    </View>
  );
}
