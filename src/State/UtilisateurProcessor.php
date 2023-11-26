<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurProcessor implements ProcessorInterface
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasherInterface,
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $persistProcessor
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        // Handle the state
        if($data->getPlainPassword() === null) return;

        $hashed = $this->userPasswordHasherInterface->hashPassword($data, $data->getPlainPassword());

        $data->setPassword($hashed);
        $data->eraseCredentials();

        $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
